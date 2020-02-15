<?php
class Controller_Dashboard extends Controller_Authenticate{

	public function action_index()
	{
		// check if business info is defined
		$business = Model_Business::find('first');
		if (!$business) {
			Session::set_flash('warning', 'Add your business information to complete setup.');
			Response::redirect('business/create');
		}

        $unit_types = Model_Unit_Type::find('all'); 
        
        $unitTypeHasUndefinedRate = false;
        foreach ($unit_types as $unit_type) {
            $unitTypeHasUndefinedRate = count($unit_type->rates) == 0;
            if ($unitTypeHasUndefinedRate) {
                Session::set_flash('warning', "Add facilities rate for {$unit_type->name}");
                Response::redirect('facilities/rates');
            }
        }
        
		$rates = Model_Rate::find('first');
		if (!$rates) {
			Session::set_flash('warning', 'Add your facilities rates to enable bookings.');
			Response::redirect('facilities/rates');
		}

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

		$data['unit_types'] = Model_Unit_Type::find('all', array('related' => array('units' => array('order_by' => 'name'),'rates'), 'order_by' => 'name'));

		$data['guest_list'] = Model_Facility_Booking::find('all', array('related' => array('unit','bill'), 'where' => array(array('status', '!=', Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT))));

		$this->template->title = "Dashboard";
		$this->template->content = View::forge('dashboard', $data);

	}

}
