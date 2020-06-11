<?php

class Model_Dashboard extends \Orm\Model
{
    public static function get_accommodation_stats()
    {
        $data = array();
        $unit_types = Model_Unit_Type::find('all', 
                                            array(
                                                'related' => array(
                                                    'units' => array(
                                                        'order_by' => 'name'
                                                    ), 
                                                    'rates'
                                                ), 
                                            'where' => array('used_for' => 'A', 'inactive' => false), 
                                            'order_by' => 'name')
                                        );
        // perform night audit
        $last_audit = Model_Summary::find('last');
        if ($last_audit) {
            if ($last_audit->date !== date('Y-m-d'))
                $data['audit_required'] = true;
        }
        else $data['audit_required'] = false;

        // perform stay over switch
        $data['checkins'] = DB::select(DB::expr('COUNT(id) as total_ci'))
                                        ->from('facility_booking')
                                        ->where(DB::expr('DATE_FORMAT(checkin, "%Y-%m-%d")'), '=', date('Y-m-d'))
                                        ->where('status', '=', Model_Facility_Booking::GUEST_STATUS_CHECKED_IN)
                                        ->execute()->as_array();
        $data['stayovers'] = DB::select(DB::expr('COUNT(id) as total_so'))
                                        ->from('facility_booking')
                                        ->where(DB::expr('DATE_FORMAT(checkin, "%Y-%m-%d")'), '!=', date('Y-m-d'))
                                        ->where('status', '=', Model_Facility_Booking::GUEST_STATUS_CHECKED_IN)
                                        ->execute()->as_array();
        $data['checkouts'] = DB::select(DB::expr('COUNT(id) as total_co'))
                                        ->from('facility_booking')
                                        ->where(DB::expr('DATE_FORMAT(checkout, "%Y-%m-%d")'), '=', date('Y-m-d'))
                                        ->where('status', '=', Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT)
                                        ->execute()->as_array();
        if ($data['stayovers'])
            $data['rollover_required'] = true;
        else $data['rollover_required'] = false;

        $data['receipts'] = DB::select(DB::expr('COALESCE(SUM(amount), 0) as total_amount'))
                                            ->from('sales_payment')
                                            ->where('sales_payment.date', '=', date('Y-m-d'))
                                            ->execute()->as_array();

        $data['expenses'] = DB::select(DB::expr('COALESCE(SUM(amount), 0) as total_amount'))
                                            ->from('expense')
                                            ->where('expense.date', '=', date('Y-m-d'))
                                            ->execute()->as_array();

        $data['deposits'] = DB::select(DB::expr('COALESCE(SUM(amount), 0) as total_amount'))
                                            ->from('bank_deposit')
                                            ->where('bank_deposit.date', '=', date('Y-m-d'))
                                            ->execute()->as_array();

        $data['units_occupied'] = DB::select(DB::expr('COUNT(id) as count'))
                                        ->from('unit')
                                        ->where('status', '=', Model_Unit::UNIT_STATUS_OCCUPIED)
                                        ->execute()->as_array();

        $data['units_vacant'] = DB::select(DB::expr('COUNT(id) as count'))
                                        ->from('unit')
                                        ->where('status', '=', Model_Unit::UNIT_STATUS_VACANT)
                                        ->execute()->as_array();

        $data['units_blocked'] = DB::select(DB::expr('COUNT(id) as count'))
                                        ->from('unit')
                                        ->where('status', '=', Model_Unit::UNIT_STATUS_BLOCKED)
                                        ->execute()->as_array();

        $data['unit_types'] = $unit_types;

        $data['customer_list'] = Model_Facility_Booking::find('all', array(
                                    'related' => array('unit','bill'), 
                                    'where' => array( 
                                        array(
                                            'status', '!=', Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT)
                                        )
                                    )
                                );
        return $data;
    }
 
    public static function get_rental_stats()
    {
        $data = array();
        $unit_types = Model_Unit_Type::find('all', 
                                            array(
                                                'related' => array(
                                                    'units' => array(
                                                        'order_by' => 'name'
                                                    ), 
                                                    'rates'
                                                ), 
                                            'where' => array('used_for' => 'R', 'inactive' => false), 
                                            'order_by' => 'name')
                                        );
        // perform monthly audit on rental units
        $last_audit = Model_Summary::find('last');
        if ($last_audit) {
            if ($last_audit->date !== date('Y-m-d'))
                $data['audit_required'] = true;
        }
        else $data['audit_required'] = false;

        // Movement
        $data['new_leases'] = DB::select(DB::expr('COUNT(id) as total_new'))
                                        ->from('leases')
                                        ->where(DB::expr('DATE_FORMAT(start_date, "%Y-%m")'), '=', date('Y-m'))
                                        ->where('status', '=', Model_Lease::TENANT_STATUS_INCOMING)
                                        ->execute()->as_array();
        $data['active_leases'] = DB::select(DB::expr('COUNT(id) as total_active'))
                                        ->from('leases')
                                        ->where(DB::expr('DATE_FORMAT(start_date, "%Y-%m")'), '!=', date('Y-m'))
                                        ->where('status', '=', Model_Lease::TENANT_STATUS_ONGOING)
                                        ->execute()->as_array();
        $data['expiring_leases'] = DB::select(DB::expr('COUNT(id) as total_ending'))
                                        ->from('leases')
                                        ->where(DB::expr('DATE_FORMAT(end_date, "%Y-%m")'), '=', date('Y-m'))
                                        ->where('status', '=', Model_Lease::TENANT_STATUS_OUTGOING)
                                        ->execute()->as_array();
        // Payments
        $data['receipts'] = DB::select(DB::expr('COALESCE(SUM(amount), 0) as total_amount'))
                                            ->from('sales_payment')
                                            ->where('sales_payment.date', '=', date('Y-m-d'))
                                            ->execute()->as_array();

        $data['expenses'] = DB::select(DB::expr('COALESCE(SUM(amount), 0) as total_amount'))
                                            ->from('expense')
                                            ->where('expense.date', '=', date('Y-m-d'))
                                            ->execute()->as_array();

        $data['deposits'] = DB::select(DB::expr('COALESCE(SUM(amount), 0) as total_amount'))
                                            ->from('bank_deposit')
                                            ->where('bank_deposit.date', '=', date('Y-m-d'))
                                            ->execute()->as_array();
        // Occupancy
        $data['units_occupied'] = DB::select(DB::expr('COUNT(id) as count'))
                                        ->from('unit')
                                        ->where('status', '=', Model_Unit::UNIT_STATUS_OCCUPIED)
                                        ->execute()->as_array();

        $data['units_vacant'] = DB::select(DB::expr('COUNT(id) as count'))
                                        ->from('unit')
                                        ->where('status', '=', Model_Unit::UNIT_STATUS_VACANT)
                                        ->execute()->as_array();

        $data['units_blocked'] = DB::select(DB::expr('COUNT(id) as count'))
                                        ->from('unit')
                                        ->where('status', '=', Model_Unit::UNIT_STATUS_BLOCKED)
                                        ->execute()->as_array();

        $data['unit_types'] = $unit_types;

        $data['customer_list'] = Model_Lease::find('all', array(
                                    'related' => array('tenant','bill'), 
                                    // 'where' => array( 
                                    //     array(
                                    //         'status', '!=', Model_Lease::TENANT_STATUS_OUTGOING)
                                    //     )
                                    )
                                );
        return $data;
    }
    
    public static function get_hire_stats()
    {
        $data = array();
        $unit_types = Model_Unit_Type::find('all', 
                                            array(
                                                'related' => array(
                                                    'units' => array(
                                                        'order_by' => 'name'
                                                    ), 
                                                    'rates'
                                                ), 
                                            'where' => array('used_for' => 'H', 'inactive' => false), 
                                            'order_by' => 'name')
                                        );
        // perform weekly audit
        $last_audit = Model_Summary::find('last');
        if ($last_audit) {
            if ($last_audit->date !== date('Y-m-d'))
                $data['audit_required'] = true;
        }
        else $data['audit_required'] = false;

        // Movement
        $data['checkins'] = DB::select(DB::expr('COUNT(id) as total_ci'))
                                        ->from('facility_booking')
                                        ->where(DB::expr('DATE_FORMAT(checkin, "%Y-%m")'), '=', date('Y-m'))
                                        ->where('status', '=', Model_Lease::TENANT_STATUS_INCOMING)
                                        ->execute()->as_array();
        $data['stayovers'] = DB::select(DB::expr('COUNT(id) as total_so'))
                                        ->from('facility_booking')
                                        ->where(DB::expr('DATE_FORMAT(checkin, "%Y-%m")'), '!=', date('Y-m'))
                                        ->where('status', '=', Model_Lease::TENANT_STATUS_ONGOING)
                                        ->execute()->as_array();
        $data['checkouts'] = DB::select(DB::expr('COUNT(id) as total_co'))
                                        ->from('facility_booking')
                                        ->where(DB::expr('DATE_FORMAT(checkout, "%Y-%m")'), '=', date('Y-m'))
                                        ->where('status', '=', Model_Lease::TENANT_STATUS_OUTGOING)
                                        ->execute()->as_array();
        // Payments
        $data['receipts'] = DB::select(DB::expr('COALESCE(SUM(amount), 0) as total_amount'))
                                            ->from('sales_payment')
                                            ->where('sales_payment.date', '=', date('Y-m-d'))
                                            ->execute()->as_array();

        $data['expenses'] = DB::select(DB::expr('COALESCE(SUM(amount), 0) as total_amount'))
                                            ->from('expense')
                                            ->where('expense.date', '=', date('Y-m-d'))
                                            ->execute()->as_array();

        $data['deposits'] = DB::select(DB::expr('COALESCE(SUM(amount), 0) as total_amount'))
                                            ->from('bank_deposit')
                                            ->where('bank_deposit.date', '=', date('Y-m-d'))
                                            ->execute()->as_array();
        // Occupancy
        $data['units_occupied'] = DB::select(DB::expr('COUNT(id) as count'))
                                        ->from('unit')
                                        ->where('status', '=', Model_Unit::UNIT_STATUS_OCCUPIED)
                                        ->execute()->as_array();

        $data['units_vacant'] = DB::select(DB::expr('COUNT(id) as count'))
                                        ->from('unit')
                                        ->where('status', '=', Model_Unit::UNIT_STATUS_VACANT)
                                        ->execute()->as_array();

        $data['units_blocked'] = DB::select(DB::expr('COUNT(id) as count'))
                                        ->from('unit')
                                        ->where('status', '=', Model_Unit::UNIT_STATUS_BLOCKED)
                                        ->execute()->as_array();

        $data['unit_types'] = $unit_types;

        $data['customer_list'] = Model_Lease::find('all', array(
                                    'related' => array('tenant','bill'), 
                                    // 'where' => array( 
                                    //     array(
                                    //         'status', '!=', Model_Lease::TENANT_STATUS_OUTGOING)
                                    //     )
                                    )
                                );
        return $data;
    }
    
}