<?php

class Model_Report_Creator
{
    public static function generate($rpt_slug, $date = null, $month = null)
    {
        $columns = $r_total = $ch_summary = $rw_summary = [];

        switch ($rpt_slug) {
            case 'check-in-out-and-stay-over':
                $columns = array('reg_no'=>'Reg #', 'first_name'=>'First name', 'last_name'=>'Last name', 'phone' => 'Phone', 'id_numer'=>'ID No.', 'room.name'=>'Room no.', 'checkin'=>'Check in', 'checkout'=>'Check out', 'duration'=>'Nights');
                $r_data = DB::select('reg_no', 'first_name', 'last_name', 'phone', 'id_number', 'room.name', DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i")'), DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i")'), 'duration')
                                    ->from('fd_booking')
                                    ->join('room')->on('room.id','=','fd_booking.room_id')
                                    ->join('sales_invoice')->on('sales_invoice.booking_id','=','fd_booking.id')
                                    ->or_where('checkin', 'LIKE', '%' . $date . '%')
                                    ->or_where('checkout', 'LIKE', '%' . $date . '%')
                                    ->or_where(DB::expr('UNIX_TIMESTAMP(DATE_FORMAT(checkout, "%Y-%m-%d"))'), '>', strtotime($date)) // Stay Over
                                    ->where(DB::expr('UNIX_TIMESTAMP(checkin)'), '<', strtotime($date)) // Stay Over
                                    ->order_by('reg_no')
                                    ->order_by('checkin')
                                    ->order_by('checkout')
                                    ->execute()->as_array();
                break;

            case 'daily-summary':
                $columns = array('*');
                $r_data = DB::select('*')
                                    ->from('summary')
                                    ->where('date', '=', $date)
                                    ->execute()->as_array();
                break;

            case 'daily-settlement':
                $columns = array('invoice_num'=>'Folio no.',
                                'bill_amount'=>'Amount due',
                                'cash_receipt.reference'=>'Receipt #',
                                'cash_receipt.amount'=>'Amount paid',
                                'advance_paid'=>'Advance paid',
                                'first_name'=>'Firstname(s)',
                                'last_name'=>'Surname',
                                'room.name'=>'Room no.',
                                'checkin'=>'Check in',
                                'checkout'=>'Check out',
                                'status'=>'Status');

                $r_data = DB::select('invoice_num',
                            DB::expr('FORMAT(sales_invoice.amount_due, 0) as amount_due'),
                            'cash_receipt.reference',
                            DB::expr('FORMAT(cash_receipt.amount, 0) as amount_paid'),
                            DB::expr('FORMAT(sales_invoice.advance_paid, 0) as advance_paid'),
                            'first_name', 'last_name', 'room.name',
                            DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i") as checkin_date'),
                            DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i") as checkout_date'),
                            'fd_booking.status')
                                    ->from('fd_booking')
                                    ->join('sales_invoice')->on('sales_invoice.booking_id','=','fd_booking.id')
                                    ->join('cash_receipt')->on('cash_receipt.bill_id','=','sales_invoice.id')
                                    ->join('room')->on('room.id','=','fd_booking.room_id')
                                    ->join('room_type')->on('room_type.id','=','room.room_type')
                                    ->join('rate')->on('rate.type_id','=','room_type.id')
                                    ->where('cash_receipt.date', '=', $date)
                                    ->order_by('cash_receipt.reference')
                                    ->execute()->as_array();

                $r_total = DB::select(DB::expr('FORMAT(SUM(amount), 0) as total_amount')) // 'date',
                                    ->from('cash_receipt')
                                    ->where('cash_receipt.date', 'LIKE', '%' . $date . '%')
                                    ->order_by('date')
                                    ->execute()->as_array();
                break;

                case 'daily-outstanding':
                    $columns = array('invoice_num' => 'Folio no.',
                                    'room_amount' => 'Rate', 'bill_amount' => 'Amount due', 'balance_amt' => 'Balance',
                                    'first_name' => 'Firstname(s)', 'last_name' => 'Surname',
                                    'room.name' => 'Room no.', 'checkin' => 'Check in', 'checkout' => 'Check out',
                                    );

                    $r_data = DB::select('invoice_num',
                                    DB::expr('FORMAT(rate.charges, 0) as room_rate'),
                                    // Calculate an amount due of period stayed
                                    DB::expr("FORMAT(amount_due, 0)"),
                                    // Calculate an incremental balance
                                    DB::expr("FORMAT(IF(disc_total > 0,
                                             IF(
                                                IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                                (
                                                        SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                        FROM   cash_receipt
                                                        WHERE  bill_id = sales_invoice.id
                                                        AND    date BETWEEN issue_date AND '$date') - disc_total <= 0, 0,
                                                IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                                (
                                                        SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                        FROM   cash_receipt
                                                        WHERE  bill_id = sales_invoice.id
                                                        AND    date BETWEEN issue_date AND '$date') - disc_total),
                                                IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                                (
                                                        SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                        FROM   cash_receipt
                                                        WHERE  bill_id = sales_invoice.id
                                                        AND    date BETWEEN issue_date AND '$date')
                                                ), 0) as balance_amt"),
                                    'first_name', 'last_name', 'room.name',
                                    DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i")'),
                                    DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i")')
                                    )
                                    ->from('fd_booking')
                                    ->join('sales_invoice')->on('sales_invoice.booking_id','=','fd_booking.id')
                                    ->join('room')->on('room.id','=','fd_booking.room_id')
                                    ->join('room_type')->on('room_type.id','=','room.room_type')
                                    ->join('rate')->on('rate.type_id','=','room_type.id')
                                    ->where('sales_invoice.balance_due', '>', 0)
                                    ->where('sales_invoice.status', '=', 'O')
                                    ->where('sales_invoice.issue_date', '<=', $date)
                                    ->where('sales_invoice.due_date', '>=', $date)
                                    ->order_by('reg_no')
                                    ->execute()->as_array();
                    // echo DB::last_query();exit;
                    $r_total = DB::select(DB::expr("FORMAT(SUM(IF(disc_total > 0,
                                     IF(
                                        IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                        (
                                                SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                FROM   cash_receipt
                                                WHERE  bill_id = sales_invoice.id
                                                AND    date BETWEEN issue_date AND '$date') - disc_total <= 0, 0,
                                        IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                        (
                                                SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                FROM   cash_receipt
                                                WHERE  bill_id = sales_invoice.id
                                                AND    date BETWEEN issue_date AND '$date') - disc_total),
                                        IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                        (
                                                SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                FROM   cash_receipt
                                                WHERE  bill_id = sales_invoice.id
                                                AND    date BETWEEN issue_date AND '$date')
                                        )), 0) as total_amount"))
                                        ->from('fd_booking')
                                        ->join('sales_invoice')->on('sales_invoice.booking_id','=','fd_booking.id')
                                        ->join('room')->on('room.id','=','fd_booking.room_id')
                                        ->join('room_type')->on('room_type.id','=','room.room_type')
                                        ->join('rate')->on('rate.type_id','=','room_type.id')
                                        ->where('sales_invoice.balance_due', '>', 0)
                                        ->where('sales_invoice.status', '=', 'O')
                                        ->where('sales_invoice.issue_date', '<=', $date)
                                        ->where('sales_invoice.due_date', '>=', $date)
                                        ->execute()->as_array();
                    // echo DB::last_query();exit;
                    break;

                case 'daily-expenses':
                    $columns = array('reference'=>'Reference', 'date' => 'Date', 'description' => 'Description', 'amount' => 'Amount', 'payee'=>'Payee');
                    $r_data = DB::select('reference', DB::expr('DATE_FORMAT(date, "%d-%b-%Y")'), 'description', DB::expr('FORMAT(amount, 2)'), 'payee')
                                        ->from('cash_payment')
                                        ->where('date', '=', $date)
                                        ->order_by('reference')
                                        ->execute()->as_array();

                    $r_total = DB::select(DB::expr('FORMAT(SUM(amount), 2) as total_amount')) // 'date',
                                        ->from('cash_payment')
                                        ->where('date', 'LIKE', '%' . $date . '%')
                                        ->execute()->as_array();
                    break;

                case 'room-availability':
                    $columns = array('name'=>'Room No.', 'status'=>'Status');
                    $r_data = DB::query("SELECT name, room.status
                                        FROM room
                                        LEFT OUTER JOIN fd_booking ON fd_booking.room_id = room.id
                                        ORDER BY name", DB::SELECT)->execute()->as_array();
                    break;
            default:
        }

        $report['column_headers'] = $columns;
        $report['row_results'] = $r_data;
        $report['total_rows'] = $r_total;
        $report['summary_cols'] = $ch_summary;
        $report['summary_rows'] = $rw_summary;

        return $report;
    }

    public static function generateSummary($date, $period = 'D')
    {
        $start_date = strtotime($date);
        $end_date = strtotime('+1 day', strtotime($date));
        if ($period = 'M') {
            $start_date = $date . '-01';
            $end_date = $date . '-31';
        }

        $report['data_rows']['room_rent'] = DB::query(
                "SELECT sum(total_payment) as total_rent
                    FROM fd_booking
                    WHERE checkin LIKE '%{$date}%'
                        OR (UNIX_TIMESTAMP(DATE_FORMAT(checkin, '%Y-%m-%d')) <= {$start_date}
                        AND UNIX_TIMESTAMP(DATE_FORMAT(checkout, '%Y-%m-%d')) >= {$end_date})
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['discount'] = DB::query(
                "SELECT sum(disc_total) as total_discount
                    FROM sales_invoice
                    WHERE issue_date LIKE '%{$date}%'
                        OR (DATE_FORMAT(issue_date, '%Y-%m-%d') >= {$start_date}
                        AND DATE_FORMAT(due_date, '%Y-%m-%d') <= {$end_date})
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['sold_rooms'] = DB::query(
                "SELECT count(id) as sold_rm_count
                    FROM fd_booking
                    WHERE checkin LIKE '%{$date}%'
                        OR (DATE_FORMAT(checkin, '%Y-%m-%d') <= {$start_date}
                        AND DATE_FORMAT(checkout, '%Y-%m-%d') >= {$end_date})
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['sold_nights'] = DB::query(
                "SELECT sum(duration) as sold_nights_count
                    FROM fd_booking
                    WHERE checkin LIKE '%{$date}%'
                        OR (DATE_FORMAT(checkin, '%Y-%m-%d') <= {$start_date}
                        AND DATE_FORMAT(checkout, '%Y-%m-%d') >= {$end_date})
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['available_rooms'] = DB::query(
                "SELECT count(id) as vacant_rm_count
                    FROM room
                    WHERE status = 'VAC'", DB::SELECT)->execute()->as_array();

        // $vacant_rooms = DB::query("SELECT * FROM room WHERE status = 'VAC'", DB::SELECT)->execute()->as_array();
        // $report['data_rows']['available_rooms_revenue'] = 0;
        // foreach ($vacant_rooms as $vac_rm)
        // {
        //     $rm_rate = DB::query("SELECT SUM(charges) as rm_rates FROM rate JOIN room_type ON room_type.id={$vac_rm['room_type']} LIMIT 1", DB::SELECT)->execute()->as_array();
        //     $report['data_rows']['available_rooms_revenue'] += $rm_rate[0]['rm_rates'];
        // }

        $report['data_rows']['guests'] = DB::query(
                "SELECT sum(pax_adults) as guest_count
                    FROM fd_booking
                    WHERE checkin LIKE '%{$date}%'
                        OR (DATE_FORMAT(checkin, '%Y-%m-%d') >= {$start_date}
                        AND DATE_FORMAT(checkout, '%Y-%m-%d') <= {$end_date})
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['deposits'] = DB::query(
                "SELECT sum(amount) as total_deposits
                    FROM bank_receipt
                    WHERE date LIKE '%{$date}%'
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['receipts'] = DB::query(
                "SELECT sum(amount) as total_receipts
                    FROM cash_receipt
                    WHERE date LIKE '%{$date}%'
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['expenses'] = DB::query(
                "SELECT sum(amount) as total_expenses
                    FROM cash_payment
                    WHERE date LIKE '%{$date}%'
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['cash_in_hand'] =
                $report['data_rows']['receipts'][0]['total_receipts'] -
                (
                    $report['data_rows']['expenses'][0]['total_expenses'] +
                    $report['data_rows']['deposits'][0]['total_deposits']
                );
        return $report['data_rows'];
    }

    public static function generateMonthly($rpt_slug, $date = null, $month = null)
    {
        $columns = $r_data = $r_total = $ch_summary = $rw_summary = [];

        switch ($rpt_slug) {
            case 'monthly-settlement':
                $columns = array('date' => 'Receipt Date(s)', 'count_payments' => 'No. of Payments', 'total_paid' => 'Total Payments');
                $r_data = DB::select(DB::expr('DATE_FORMAT(cash_receipt.date, "%d %b %Y")'),
                                    DB::expr('COUNT(reference)'),
                                    DB::expr('FORMAT(SUM(amount), 0)'))
                                    ->from('cash_receipt')
                                    ->where('date', 'LIKE', '%' . $date . '%')
                                    ->group_by('cash_receipt.date')
                                    ->order_by('date')
                                    ->execute()->as_array();

                $r_total = DB::select(DB::expr('FORMAT(SUM(amount), 0) as total_amount'))
                                    ->from('cash_receipt')
                                    ->where('date', 'LIKE', '%' . $date . '%')
                                    ->order_by('date')
                                    ->execute()->as_array();
                break;

                case 'monthly-outstanding':
                    $columns = array('invoice_num'=>'Folio no.',
                                    'room_amount'=>'Rate', 'bill_amount'=>'Amount due', 'balance_due'=>'Balance',
                                    'first_name'=>'Firstname(s)', 'last_name'=>'Surname',
                                    'room.name'=>'Room no.', 'checkin'=>'Check in', 'checkout'=>'Check out');

                    $r_data = DB::select('invoice_num',
                                        DB::expr('FORMAT(rate.charges, 0)'),
                                        DB::expr('FORMAT(sales_invoice.amount_due, 0)'),
                                        DB::expr('FORMAT(balance_due, 0)'),
                                        'first_name', 'last_name', 'room.name',
                                        DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i")'),
                                        DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i")')
                                        )
                                        ->from('fd_booking')
                                        ->join('sales_invoice')->on('sales_invoice.booking_id','=','fd_booking.id')
                                        ->join('room')->on('room.id','=','fd_booking.room_id')
                                        ->join('room_type')->on('room_type.id','=','room.room_type')
                                        ->join('rate')->on('rate.type_id','=','room_type.id')
                                        ->where('sales_invoice.balance_due', '>', 0)
                                        ->where('sales_invoice.status', '=', 'O')
                                        ->where(DB::expr('UNIX_TIMESTAMP(DATE_FORMAT(checkout, "%Y-%m-%d"))'), '>', strtotime($date . '-01')) // Stay Over
                                        ->where(DB::expr('UNIX_TIMESTAMP(checkin)'), '<', strtotime($date . '-31')) // Stay Ove
                                        ->order_by('reg_no')
                                        ->execute()->as_array();

                    $r_total = DB::select(DB::expr('FORMAT(SUM(balance_due), 0) as total_amount')) // 'date',
                                        ->from('sales_invoice')
                                        ->where('sales_invoice.balance_due', '>', 0)
                                        ->where('sales_invoice.status', '=', 'O')
                                        ->where(DB::expr('UNIX_TIMESTAMP(due_date)'), '>', strtotime($date . '-01')) // Stay Over
                                        ->where(DB::expr('UNIX_TIMESTAMP(issue_date)'), '<', strtotime($date . '-31')) // Stay Ove
                                        ->execute()->as_array();
                    break;

                case 'monthly-expenses':
                    $columns = array('date' => 'Voucher Date(s)', 'count_vouchers' => 'No. of Vouchers', 'total_paid' => 'Total Payments');
                    $r_data = DB::select(DB::expr('DATE_FORMAT(cash_payment.date, "%d %b %Y")'),
                                        DB::expr('COUNT(reference)'),
                                        DB::expr('FORMAT(SUM(amount), 0)'))
                                        ->from('cash_payment')
                                        ->where('date', 'LIKE', '%' . $date . '%')
                                        ->group_by('cash_payment.date')
                                        ->order_by('cash_payment.date')
                                        ->execute()->as_array();

                    $r_total = DB::select(DB::expr('FORMAT(SUM(amount), 0) as total_amount'))
                                        ->from('cash_payment')
                                        ->where('cash_payment.date', 'LIKE', '%' . $date . '%')
                                        ->order_by('cash_payment.date')
                                        ->execute()->as_array();
                    break;

                case 'room-revenue':
                    $columns = array('name' => 'Room No.', 'amount' => 'Amount Paid');
                    $r_data = DB::select('name', DB::expr('FORMAT(SUM(amount), 0) as total_amount'))
                                        ->from('room')
                                        ->join('fd_booking')->on('fd_booking.room_id','=','room.id')
                                        ->join('sales_invoice')->on('sales_invoice.booking_id','=','fd_booking.id')
                                        ->join('cash_receipt')->on('cash_receipt.bill_id','=','sales_invoice.id')
                                        ->where('cash_receipt.date', 'LIKE', '%' . $date . '%') // 2016-09
                                        ->order_by('name')
                                        ->group_by('name')
                                        ->execute()->as_array();
                break;

                case 'room-history':
                    $columns = array('room.name' => 'Room no.','first_name' => 'Firstname(s)', 'last_name' => 'Surname', 'checkin' => 'Check in', 'checkout' => 'Check out', 'duration'=> 'Nights');
                    $r_data = DB::select('room.name', 'first_name', 'last_name', DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i")'), DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i")'), 'duration')
                                        ->from('fd_booking')
                                        ->join('room')->on('room.id','=','fd_booking.room_id')
                                        ->order_by('room.name')
                                        ->order_by('checkin')
                                        ->execute()->as_array();
                break;
            default:
        }

        $report['column_headers'] = $columns;
        $report['row_results'] = $r_data;
        $report['total_rows'] = $r_total;
        $report['summary_cols'] = $ch_summary;
        $report['summary_rows'] = $rw_summary;

        return $report;
    }
}
