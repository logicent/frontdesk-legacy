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

		$rates = Model_Rate::find('first');
		if (!$rates) {
			Session::set_flash('warning', 'Add your accommodation rates to enable bookings.');
			Response::redirect('accommodation/rates');
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
										->from('fd_booking')
										->where(DB::expr('DATE_FORMAT(checkin, "%Y-%m-%d")'), '=', date('Y-m-d'))
										->where('status', '=', Model_Fd_Booking::GUEST_STATUS_CHECKED_IN)
										->execute()->as_array();
		$data['stayovers'] = DB::select(DB::expr('COUNT(id) as total_so'))
										->from('fd_booking')
										->where(DB::expr('DATE_FORMAT(checkin, "%Y-%m-%d")'), '!=', date('Y-m-d'))
										->where('status', '=', Model_Fd_Booking::GUEST_STATUS_CHECKED_IN)
										->execute()->as_array();
		$data['checkouts'] = DB::select(DB::expr('COUNT(id) as total_co'))
										->from('fd_booking')
										->where(DB::expr('DATE_FORMAT(checkout, "%Y-%m-%d")'), '=', date('Y-m-d'))
										->where('status', '=', Model_Fd_Booking::GUEST_STATUS_CHECKED_OUT)
										->execute()->as_array();
		if ($data['stayovers'])
			$data['rollover_required'] = true;
		else $data['rollover_required'] = false;

		$data['receipts'] = DB::select(DB::expr('FORMAT(SUM(amount), 0) as total_amount'))
											->from('cash_receipt')
											->where('cash_receipt.date', '=', date('Y-m-d'))
											->execute()->as_array();

		$data['expenses'] = DB::select(DB::expr('FORMAT(SUM(amount), 0) as total_amount'))
											->from('cash_payment')
											->where('cash_payment.date', '=', date('Y-m-d'))
											->execute()->as_array();

		$data['deposits'] = DB::select(DB::expr('FORMAT(SUM(amount), 0) as total_amount'))
											->from('bank_receipt')
											->where('bank_receipt.date', '=', date('Y-m-d'))
											->execute()->as_array();

		$data['rooms_occupied'] = DB::select(DB::expr('COUNT(id) as count'))
										->from('room')
										->where('status', '=', Model_Room::ROOM_STATUS_OCCUPIED)
										->execute()->as_array();

		$data['rooms_vacant'] = DB::select(DB::expr('COUNT(id) as count'))
										->from('room')
										->where('status', '=', Model_Room::ROOM_STATUS_VACANT)
										->execute()->as_array();

		$data['rooms_blocked'] = DB::select(DB::expr('COUNT(id) as count'))
										->from('room')
										->where('status', '=', Model_Room::ROOM_STATUS_BLOCKED)
										->execute()->as_array();

		$data['room_types'] = Model_Room_Type::find('all', array('related' => array('rooms' => array('order_by' => 'name'),'rates'), 'order_by' => 'name'));

		$data['guest_list'] = Model_Fd_Booking::find('all', array('related' => array('room','bill'), 'where' => array(array('status', '!=', Model_Fd_Booking::GUEST_STATUS_CHECKED_OUT))));

		$this->template->title = "Dashboard";
		$this->template->content = View::forge('dashboard', $data);

	}

}
