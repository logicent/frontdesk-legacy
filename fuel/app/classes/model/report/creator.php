<?php

class Model_Report_Creator
{
    public static function generate($rpt_slug, $date = null, $month = null)
    {
        $columns = $r_total = $ch_summary = $rw_summary = [];

        switch ($rpt_slug) {
            case 'check-in-out-and-stay-over':
                $columns = array('reg_no'=>'Reg #', 'customer_name'=>'Customer name', 'phone' => 'Phone', 'id_numer'=>'ID No.', 'unit.name'=>'Unit no.', 'checkin'=>'Check in', 'checkout'=>'Check out', 'duration'=>'Nights');
                $r_data = DB::select('reg_no', 'facility_booking.customer_name', 'phone', 'id_number', 'unit.name', DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i")'), DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i")'), 'duration')
                                    ->from('facility_booking')
                                    ->join('unit')->on('unit.id','=','facility_booking.unit_id')
                                    ->join('sales_invoice')->on('sales_invoice.source_id','=','facility_booking.id')
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
                                'sales_payment.reference'=>'Receipt #',
                                'sales_payment.amount'=>'Amount paid',
                                'advance_paid'=>'Advance paid',
                                'customer_name'=>'Customer name',
                                'unit.name'=>'Unit no.',
                                'checkin'=>'Check in',
                                'checkout'=>'Check out',
                                'status'=>'Status');

                $r_data = DB::select('invoice_num',
                            DB::expr('FORMAT(sales_invoice.amount_due, 0) as amount_due'),
                            'sales_payment.reference',
                            DB::expr('FORMAT(sales_payment.amount, 0) as amount_paid'),
                            DB::expr('FORMAT(sales_invoice.advance_paid, 0) as advance_paid'),
                            'facility_booking.customer_name', 'unit.name',
                            DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i") as checkin_date'),
                            DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i") as checkout_date'),
                            'facility_booking.status')
                                    ->from('facility_booking')
                                    ->join('sales_invoice')->on('sales_invoice.source_id','=','facility_booking.id')
                                    ->join('sales_payment')->on('sales_payment.bill_id','=','sales_invoice.id')
                                    ->join('unit')->on('unit.id','=','facility_booking.unit_id')
                                    ->join('unit_type')->on('unit_type.id','=','unit.unit_type')
                                    ->join('rate')->on('rate.type_id','=','unit_type.id')
                                    ->where('sales_payment.date', '=', $date)
                                    ->order_by('sales_payment.reference')
                                    ->execute()->as_array();

                $r_total = DB::select(DB::expr('FORMAT(SUM(amount), 0) as total_amount')) // 'date',
                                    ->from('sales_payment')
                                    ->where('sales_payment.date', 'LIKE', '%' . $date . '%')
                                    ->order_by('date')
                                    ->execute()->as_array();
                break;

                case 'daily-outstanding':
                    $columns = array('invoice_num' => 'Folio no.',
                                    'unit_amount' => 'Rate', 'bill_amount' => 'Amount due', 'balance_amt' => 'Balance',
                                    'customer_name' => 'Customer name',
                                    'unit.name' => 'Unit no.', 'checkin' => 'Check in', 'checkout' => 'Check out',
                                    );

                    $r_data = DB::select('invoice_num',
                                    DB::expr('FORMAT(rate.charges, 0) as unit_rate'),
                                    // Calculate an amount due of period stayed
                                    DB::expr("FORMAT(amount_due, 0)"),
                                    // Calculate an incremental balance
                                    DB::expr("FORMAT(IF(disc_total > 0,
                                             IF(
                                                IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                                (
                                                        SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                        FROM   sales_payment
                                                        WHERE  bill_id = sales_invoice.id
                                                        AND    date BETWEEN issue_date AND '$date') - disc_total <= 0, 0,
                                                IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                                (
                                                        SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                        FROM   sales_payment
                                                        WHERE  bill_id = sales_invoice.id
                                                        AND    date BETWEEN issue_date AND '$date') - disc_total),
                                                IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                                (
                                                        SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                        FROM   sales_payment
                                                        WHERE  bill_id = sales_invoice.id
                                                        AND    date BETWEEN issue_date AND '$date')
                                                ), 0) as balance_amt"),
                                    'facility_booking.customer_name', 'unit.name',
                                    DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i")'),
                                    DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i")')
                                    )
                                    ->from('facility_booking')
                                    ->join('sales_invoice')->on('sales_invoice.source_id','=','facility_booking.id')
                                    ->join('unit')->on('unit.id','=','facility_booking.unit_id')
                                    ->join('unit_type')->on('unit_type.id','=','unit.unit_type')
                                    ->join('rate')->on('rate.type_id','=','unit_type.id')
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
                                                FROM   sales_payment
                                                WHERE  bill_id = sales_invoice.id
                                                AND    date BETWEEN issue_date AND '$date') - disc_total <= 0, 0,
                                        IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                        (
                                                SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                FROM   sales_payment
                                                WHERE  bill_id = sales_invoice.id
                                                AND    date BETWEEN issue_date AND '$date') - disc_total),
                                        IF(Datediff('$date', issue_date), rate.charges * Datediff('$date', issue_date), rate.charges) -
                                        (
                                                SELECT IF(Sum(amount) > 0, Sum(amount), 0)
                                                FROM   sales_payment
                                                WHERE  bill_id = sales_invoice.id
                                                AND    date BETWEEN issue_date AND '$date')
                                        )), 0) as total_amount"))
                                        ->from('facility_booking')
                                        ->join('sales_invoice')->on('sales_invoice.source_id','=','facility_booking.id')
                                        ->join('unit')->on('unit.id','=','facility_booking.unit_id')
                                        ->join('unit_type')->on('unit_type.id','=','unit.unit_type')
                                        ->join('rate')->on('rate.type_id','=','unit_type.id')
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
                                        ->from('expense')
                                        ->where('date', '=', $date)
                                        ->order_by('reference')
                                        ->execute()->as_array();

                    $r_total = DB::select(DB::expr('FORMAT(SUM(amount), 2) as total_amount')) // 'date',
                                        ->from('expense')
                                        ->where('date', 'LIKE', '%' . $date . '%')
                                        ->execute()->as_array();
                    break;

                case 'unit-availability':
                    $columns = array('name'=>'Unit No.', 'status'=>'Status');
                    $r_data = DB::query("SELECT name, unit.status
                                        FROM unit
                                        LEFT OUTER JOIN facility_booking ON facility_booking.unit_id = unit.id
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

        $report['data_rows']['unit_rent'] = DB::query(
                "SELECT sum(total_payment) as total_rent
                    FROM facility_booking
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

        $report['data_rows']['sold_units'] = DB::query(
                "SELECT count(id) as sold_rm_count
                    FROM facility_booking
                    WHERE checkin LIKE '%{$date}%'
                        OR (DATE_FORMAT(checkin, '%Y-%m-%d') <= {$start_date}
                        AND DATE_FORMAT(checkout, '%Y-%m-%d') >= {$end_date})
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['sold_nights'] = DB::query(
                "SELECT sum(duration) as sold_nights_count
                    FROM facility_booking
                    WHERE checkin LIKE '%{$date}%'
                        OR (DATE_FORMAT(checkin, '%Y-%m-%d') <= {$start_date}
                        AND DATE_FORMAT(checkout, '%Y-%m-%d') >= {$end_date})
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['available_units'] = DB::query(
                "SELECT count(id) as vacant_rm_count
                    FROM unit
                    WHERE status = 'VAC'", DB::SELECT)->execute()->as_array();

        // $vacant_units = DB::query("SELECT * FROM unit WHERE status = 'VAC'", DB::SELECT)->execute()->as_array();
        // $report['data_rows']['available_units_revenue'] = 0;
        // foreach ($vacant_units as $vac_rm)
        // {
        //     $rm_rate = DB::query("SELECT SUM(charges) as rm_rates FROM rate JOIN unit_type ON unit_type.id={$vac_rm['unit_type']} LIMIT 1", DB::SELECT)->execute()->as_array();
        //     $report['data_rows']['available_units_revenue'] += $rm_rate[0]['rm_rates'];
        // }

        $report['data_rows']['guests'] = DB::query(
                "SELECT sum(pax_adults) as guest_count
                    FROM facility_booking
                    WHERE checkin LIKE '%{$date}%'
                        OR (DATE_FORMAT(checkin, '%Y-%m-%d') >= {$start_date}
                        AND DATE_FORMAT(checkout, '%Y-%m-%d') <= {$end_date})
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['deposits'] = DB::query(
                "SELECT sum(amount) as total_deposits
                    FROM bank_deposit
                    WHERE date LIKE '%{$date}%'
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['receipts'] = DB::query(
                "SELECT sum(amount) as total_receipts
                    FROM sales_payment
                    WHERE date LIKE '%{$date}%'
                        AND isNull(deleted_at)", DB::SELECT)->execute()->as_array();

        $report['data_rows']['expenses'] = DB::query(
                "SELECT sum(amount) as total_expenses
                    FROM expense
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
                $r_data = DB::select(DB::expr('DATE_FORMAT(sales_payment.date, "%d %b %Y")'),
                                    DB::expr('COUNT(reference)'),
                                    DB::expr('FORMAT(SUM(amount), 0)'))
                                    ->from('sales_payment')
                                    ->where('date', 'LIKE', '%' . $date . '%')
                                    ->group_by('sales_payment.date')
                                    ->order_by('date')
                                    ->execute()->as_array();

                $r_total = DB::select(DB::expr('FORMAT(SUM(amount), 0) as total_amount'))
                                    ->from('sales_payment')
                                    ->where('date', 'LIKE', '%' . $date . '%')
                                    ->order_by('date')
                                    ->execute()->as_array();
                break;

                case 'monthly-outstanding':
                    $columns = array('invoice_num'=>'Folio no.',
                                    'unit_amount'=>'Rate', 'bill_amount'=>'Amount due', 'balance_due'=>'Balance',
                                    'customer_name'=>'Customer name',
                                    'unit.name'=>'Unit no.', 'checkin'=>'Check in', 'checkout'=>'Check out');

                    $r_data = DB::select('invoice_num',
                                        DB::expr('FORMAT(rate.charges, 0)'),
                                        DB::expr('FORMAT(sales_invoice.amount_due, 0)'),
                                        DB::expr('FORMAT(balance_due, 0)'),
                                        'facility_booking.customer_name', 'unit.name',
                                        DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i")'),
                                        DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i")')
                                        )
                                        ->from('facility_booking')
                                        ->join('sales_invoice')->on('sales_invoice.source_id','=','facility_booking.id')
                                        ->join('unit')->on('unit.id','=','facility_booking.unit_id')
                                        ->join('unit_type')->on('unit_type.id','=','unit.unit_type')
                                        ->join('rate')->on('rate.type_id','=','unit_type.id')
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
                    $r_data = DB::select(DB::expr('DATE_FORMAT(expense.date, "%d %b %Y")'),
                                        DB::expr('COUNT(reference)'),
                                        DB::expr('FORMAT(SUM(amount), 0)'))
                                        ->from('expense')
                                        ->where('date', 'LIKE', '%' . $date . '%')
                                        ->group_by('expense.date')
                                        ->order_by('expense.date')
                                        ->execute()->as_array();

                    $r_total = DB::select(DB::expr('FORMAT(SUM(amount), 0) as total_amount'))
                                        ->from('expense')
                                        ->where('expense.date', 'LIKE', '%' . $date . '%')
                                        ->order_by('expense.date')
                                        ->execute()->as_array();
                    break;

                case 'unit-revenue':
                    $columns = array('name' => 'Unit No.', 'amount' => 'Amount Paid');
                    $r_data = DB::select('name', DB::expr('FORMAT(SUM(amount), 0) as total_amount'))
                                        ->from('unit')
                                        ->join('facility_booking')->on('facility_booking.unit_id','=','unit.id')
                                        ->join('sales_invoice')->on('sales_invoice.source_id','=','facility_booking.id')
                                        ->join('sales_payment')->on('sales_payment.bill_id','=','sales_invoice.id')
                                        ->where('sales_payment.date', 'LIKE', '%' . $date . '%') // 2016-09
                                        ->order_by('name')
                                        ->group_by('name')
                                        ->execute()->as_array();
                break;

                case 'unit-history':
                    $columns = array('unit.name' => 'Unit no.','customer_name' => 'Customer name', 'checkin' => 'Check in', 'checkout' => 'Check out', 'duration'=> 'Nights');
                    $r_data = DB::select('unit.name', 'customer_name', DB::expr('DATE_FORMAT(checkin, "%d-%m-%Y %H:%i")'), DB::expr('DATE_FORMAT(checkout, "%d-%m-%Y %H:%i")'), 'duration')
                                        ->from('facility_booking')
                                        ->join('unit')->on('unit.id','=','facility_booking.unit_id')
                                        ->order_by('unit.name')
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
