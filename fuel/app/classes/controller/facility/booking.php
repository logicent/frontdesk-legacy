<?php

class Controller_Facility_Booking extends Controller_Authenticate
{
	public function action_index($show_del = false)
	{
		if ($show_del)
			$data['booking'] = Model_Facility_Booking::deleted('all');
		else
		{
			$status = Input::get('status');
			if (!$status)
				$status = Model_Facility_Booking::GUEST_STATUS_CHECKED_IN;

			$data['booking'] = Model_Facility_Booking::find('all', array('where' => array(
				array('status', '=', $status)), 'order_by' => array('reg_no' => 'desc'), 'limit' => 1000));
		}

		$data['status'] = $status;

		$this->template->title = "Bookings";
		$this->template->content = View::forge('facility/booking/index', $data);
	}

	public function action_index_all()
	{
		$data['booking'] = Model_Facility_Booking::find('all');

		$this->template->title = "Booking History";
		$this->template->content = View::forge('facility/booking/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facility/booking');

		if ( ! $data['booking'] = Model_Facility_Booking::find($id))
		{
			Session::set_flash('error', 'Could not find booking #'.$id);
			Response::redirect('facility/booking');
		}

		$this->template->title = "Booking";
		$this->template->content = View::forge('facility/booking/view', $data);
	}

	public function action_create($rm_id = null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Facility_Booking::validate('create');

			if ($val->run())
			{
				$booking = Model_Facility_Booking::forge(array(
					'reg_no' => Input::post('reg_no'),
					'folio_no' => Input::post('folio_no'),
					'room_id' => Input::post('room_id'),
					'fdesk_user' => Input::post('fdesk_user'),
					'res_no' => Input::post('res_no'),
					'status' => Input::post('status'),
					'checkin' => Input::post('checkin'),
					'checkout' => date('Y-m-d H:i:s', strtotime('+10 hours', strtotime(Input::post('checkout')))),
					'duration' => Input::post('duration'),
					'pax_adults' => Input::post('pax_adults'),
					'pax_children' => Input::post('pax_children'),
					'voucher_no' => Input::post('voucher_no'),
					'last_name' => Input::post('last_name'),
					'first_name' => Input::post('first_name'),
					'sex' => Input::post('sex'),
					'address' => Input::post('address'),
					'city' => Input::post('city'),
					'country' => Input::post('country'),
					'email' => Input::post('email'),
					'phone' => Input::post('phone'),
					'payment_type' => Input::post('payment_type'),
					'card_type' => Input::post('card_type'),
					'card_no' => Input::post('card_no'),
					'card_expire' => Input::post('card_expire'),
					'rate_type' => Input::post('rate_type'),
					'rate_amount' => Input::post('rate_amount'),
					'vat_amount' => Input::post('vat_amount'),
					'total_amount' => Input::post('total_amount'),
					'total_charge' => Input::post('total_charge'),
					'total_payment' => Input::post('total_payment'),
					'id_type' => Input::post('id_type'),
					'id_number' => Input::post('id_number'),
					'id_country' => Input::post('id_country'),
					'remarks' => Input::post('remarks'),
				));

				// Check if room is assigned or guest is registered already
				$booking = Model_Facility_Booking::find('first', array('where' => array('room_id' => $booking->room_id, 'status' => Model_Facility_Booking::GUEST_STATUS_CHECKED_IN)));
				if ($booking)
				{
					Session::set_flash('warning', 'Room is already assigned to a guest booking.');

					Response::redirect('dashboard');
				}

				// Calculate all amounts due for duration
				Model_Facility_Booking::setBillingAmounts($booking);

                try
                {
                    DB::start_transaction();
                
                    if ($booking and $booking->save())
                    {
                        // Updated Room status based of guest status
                        Model_Facility_Booking::updateRoomStatus($booking->room_id, $booking->status);
                
                        // Create default invoice for overnight stay
                        Model_Facility_Booking::createSalesInvoice($booking);
                    }
                
                    DB::commit_transaction();
                
                    Session::set_flash('success', 'Added booking #'.$booking->reg_no.'.');
                    
                    Response::redirect('dashboard');
                }
                catch (Fuel\Core\Database_Exception $e)
                {
                    DB::rollback_transaction();
                    
                    Session::set_flash('error', $e->getMessage());
                    // throw $e;
                }
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
        // to be removed when installer or init db script exists for this
		$default_service = Model_Service_Item::find('first');

		if (!$default_service)
		{
			Session::set_flash('error', 'Default lodge service must be defined to allow bookings');

			Response::redirect('service/item/create');
		}

		$room = Model_Room::find($rm_id);
		$this->template->set_global('room', $room, false);

		$this->template->title = "Booking";
		$this->template->content = View::forge('facility/booking/create');
	}

	public function action_copy()
	{
		var_dump(Input::post());
		exit;
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facility/booking');

		if ( ! $booking = Model_Facility_Booking::find($id))
		{
			Session::set_flash('error', 'Could not find booking #'.$id);
			Response::redirect('facility/booking');
		}

		$val = Model_Facility_Booking::validate('edit');

		if ($val->run())
		{
			$booking->reg_no = Input::post('reg_no');
			$booking->folio_no = Input::post('folio_no');
			$booking->room_id = Input::post('room_id');
			$booking->fdesk_user = Input::post('fdesk_user');
			$booking->res_no = Input::post('res_no');
			$booking->status = Input::post('status');
			$booking->checkin = Input::post('checkin');
			$booking->checkout = date('Y-m-d H:i:s', strtotime('+10 hours', strtotime(Input::post('checkout'))));
			$booking->duration = Input::post('duration');
			$booking->pax_adults = Input::post('pax_adults');
			$booking->pax_children = Input::post('pax_children');
			$booking->voucher_no = Input::post('voucher_no');
			$booking->last_name = Input::post('last_name');
			$booking->first_name = Input::post('first_name');
			$booking->sex = Input::post('sex');
			$booking->address = Input::post('address');
			$booking->city = Input::post('city');
			$booking->country = Input::post('country');
			$booking->email = Input::post('email');
			$booking->phone = Input::post('phone');
			$booking->payment_type = Input::post('payment_type');
			$booking->card_type = Input::post('card_type');
			$booking->card_no = Input::post('card_no');
			$booking->card_expire = Input::post('card_expire');
			$booking->rate_type = Input::post('rate_type');
			$booking->rate_amount = Input::post('rate_amount');
			$booking->vat_amount = Input::post('vat_amount');
			$booking->total_amount = Input::post('total_amount');
			$booking->total_charge = Input::post('total_charge');
			$booking->total_payment = Input::post('total_payment');
			$booking->id_type = Input::post('id_type');
			$booking->id_number = Input::post('id_number');
			$booking->id_country = Input::post('id_country');
			$booking->remarks = Input::post('remarks');

			// Calculate all amounts due for duration
			Model_Facility_Booking::setBillingAmounts($booking);

			if ($booking->save())
			{
				// update Invoice and Guest Card
				Model_Sales_Invoice::updateBillDates($booking);
				Model_Sales_Invoice::updateBillSettlement($booking);

				Session::set_flash('success', 'Updated booking #' . $booking->reg_no);

				Response::redirect('dashboard');
			}
			else
			{
				Session::set_flash('error', 'Could not update booking #' . $id);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$booking->reg_no = $val->validated('reg_no');
				$booking->folio_no = $val->validated('folio_no');
				$booking->room_id = $val->validated('room_id');
				$booking->fdesk_user = $val->validated('fdesk_user');
				$booking->res_no = $val->validated('res_no');
				$booking->status = $val->validated('status');
				$booking->checkin = $val->validated('checkin');
				$booking->checkout = $val->validated('checkout');
				$booking->duration = $val->validated('duration');
				$booking->pax_adults = $val->validated('pax_adults');
				$booking->pax_children = $val->validated('pax_children');
				$booking->voucher_no = $val->validated('voucher_no');
				$booking->last_name = $val->validated('last_name');
				$booking->first_name = $val->validated('first_name');
				$booking->sex = $val->validated('sex');
				$booking->address = $val->validated('address');
				$booking->city = $val->validated('city');
				$booking->country = $val->validated('country');
				$booking->email = $val->validated('email');
				$booking->phone = $val->validated('phone');
				$booking->payment_type = $val->validated('payment_type');
				$booking->card_type = $val->validated('card_type');
				$booking->card_no = $val->validated('card_no');
				$booking->card_expire = $val->validated('card_expire');
				$booking->rate_type = $val->validated('rate_type');
				$booking->rate_amount = $val->validated('rate_amount');
				$booking->vat_amount = $val->validated('vat_amount');
				$booking->total_amount = $val->validated('total_amount');
				$booking->total_charge = $val->validated('total_charge');
				$booking->total_payment = $val->validated('total_payment');
				$booking->id_type = $val->validated('id_type');
				$booking->id_number = $val->validated('id_number');
				$booking->id_country = $val->validated('id_country');
				$booking->remarks = $val->validated('remarks');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('booking', $booking, false);
		}

		$this->template->title = "Booking";
		$this->template->content = View::forge('facility/booking/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facility/booking');

		if ($booking = Model_Facility_Booking::find($id))
		{
			try
			{
				// start a db transaction
				// remove related invoice master/detail and cash receipts
				$booking->bill->delete();
				// change room status to avoid orphaned status
				$booking->room->status = Model_Room::ROOM_STATUS_VACANT;
				$booking->room->save();
				// remove booking
				$booking->delete();

				Session::set_flash('success', 'Deleted succeeded #'.$booking->reg_no);

			}
			catch (FuelException $e)
			{// ORM encounters Model_Room Primary Key error but it's a false error
				Session::set_flash('success', 'Delete succeeded.');
			}
		}
		else
		{
			Session::set_flash('error', 'Could not delete booking #'.$id);
		}

		Response::redirect('facility/booking');
	}

	public function action_nightaudit($date = null)
	{
		// last audit is current

		Response::redirect('dashboard');
	}

	public function action_stayover($date = null)
	{
		// check if checkout time is past
		if (date('H') < 10) // fetch time from DB
		{
			Session::set_flash('error', 'Checkout time has not passed');
			Response::redirect('dashboard');
		}

		$statuses = array(Model_Facility_Booking::GUEST_STATUS_CHECKED_IN, Model_Facility_Booking::GUEST_STATUS_STAY_OVER);
		$bookings = Model_Facility_Booking::find('all', array('where' => array(array('status', 'in', $statuses))));

		foreach ($bookings as $booking)
		{
			$checkin = date('Y-m-d', strtotime($booking->checkin));
			if ($checkin == date('Y-m-d'))
				continue;

			$today = date('Y-m-d');
			$checkout_time = 10;

			$booking->duration = round(abs(strtotime($booking->checkin) - strtotime($today)) / 86400);
			$booking->checkout = date('Y-m-d', strtotime("+{$booking->duration} day", strtotime($booking->checkout)));
			$booking->status = Model_Facility_Booking::GUEST_STATUS_STAY_OVER;
			Model_Facility_Booking::setBillingAmounts($booking);

			if ($booking->save())
				Model_Facility_Booking::updateSalesInvoice($booking);
			else
			{
				$messages[] = $booking->reg_no;
			}
		}

		if (isset($messages))
			Session::set_flash('error', 'Could not convert booking(s) to stay over #'.extract($messages));
		else Session::set_flash('success', "Stayover Guests' bookings and folios have been updated.");

		Response::redirect('dashboard');
	}

	public function action_checkout($id = null)
	{
		is_null($id) and Response::redirect('facility/booking');

		if ( ! $booking = Model_Facility_Booking::find($id))
		{
			Session::set_flash('error', 'Could not find booking #'.$id);
			Response::redirect('facility/booking');
		}
		else {
			// // check if checkout date is reached
			// if (date("Y-m-d", strtotime($booking->checkout)) !== date("Y-m-d", time()))
			// {
			// 	$checkout = date("d/m/Y", strtotime($booking->checkout));
			// 	Session::set_flash('error', "Checkout failed. Due date {$checkout} for checkout is not today.");
			// 	Response::redirect('dashboard');
			// }

			// check if guest bill is fully settled
			if ($booking->bill && $booking->bill->balance_due > 0)
			{
				Session::set_flash('error', 'Checkout failed. Guest has outstanding balance for stay period.');

				Response::redirect('cash/receipt/create/'.$booking->bill->id);
			}

			// set guest as checked out
			$booking->status = Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT;

			if ($booking->save())
			{
				Model_Facility_Booking::updateRoomStatus($booking->room_id, $booking->status);
				Model_Sales_Invoice::updateBillStatus($booking);

				Session::set_flash('success', 'Checkout for booking #' . $booking->reg_no . ' complete.');

				Response::redirect('dashboard');
			}
			else
			{
				Session::set_flash('error', 'Checkout for booking #' . $booking->reg_no . ' pending.');
			}
		}

		$this->template->title = "Booking";
		$this->template->content = View::forge('facility/booking/view', $data);

	}

	public function action_rate_list_options()
	{
		$rm_type = Model_Room::find($_GET['id'])->room_type;
		$rates = Model_Rate::find('all', array('where' => array('type_id' => $rm_type)))->to_array();
		echo json_encode($rates);
	}
}
