<?php

class Controller_Fd_Booking extends Controller_Authenticate
{
	public function action_index($show_del = false)
	{
		if ($show_del)
			$data['fd_booking'] = Model_Fd_Booking::deleted('all');
		else
		{
			$status = Input::get('status');
			if (!$status)
				$status = Model_Fd_Booking::GUEST_STATUS_CHECKED_IN;

			$data['fd_booking'] = Model_Fd_Booking::find('all', array('where' => array(
				array('status', '=', $status)), 'order_by' => array('reg_no' => 'desc'), 'limit' => 1000));
		}

		$data['status'] = $status;

		$this->template->title = "Guest Bookings";
		$this->template->content = View::forge('fd/booking/index', $data);

	}

	public function action_index_all()
	{
		$data['fd_booking'] = Model_Fd_Booking::find('all');

		$this->template->title = "Guest Booking History";
		$this->template->content = View::forge('fd/booking/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('fd/booking');

		if ( ! $data['fd_booking'] = Model_Fd_Booking::find($id))
		{
			Session::set_flash('error', 'Could not find booking #'.$id);
			Response::redirect('fd/booking');
		}

		$this->template->title = "Guest Booking";
		$this->template->content = View::forge('fd/booking/view', $data);

	}

	public function action_create($rm_id = null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Fd_Booking::validate('create');

			if ($val->run())
			{
				$fd_booking = Model_Fd_Booking::forge(array(
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
				$booking = Model_Fd_Booking::find('first', array('where' => array('room_id' => $fd_booking->room_id, 'status' => Model_Fd_Booking::GUEST_STATUS_CHECKED_IN)));
				if ($booking)
				{
					Session::set_flash('warning', 'Room is already assigned to a guest booking.');

					Response::redirect('dashboard');
				}

				// Calculate all amounts due for duration
				Model_Fd_Booking::setBillingAmounts($fd_booking);

				try {
					if ($fd_booking and $fd_booking->save())
					{
						// Updated Room status based of guest status
						Model_Fd_Booking::updateRoomStatus($fd_booking->room_id, $fd_booking->status);
						// Create default invoice for overnight stay
						Model_Fd_Booking::createSalesInvoice($fd_booking);
						Session::set_flash('success', 'Added booking #'.$fd_booking->reg_no.'.');
						Response::redirect('dashboard');
					}
				}
				catch (Fuel\Core\Database_Exception $e)
				{
					Session::set_flash('error', $e->getMessage());
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

		$this->template->title = "Guest Booking";
		$this->template->content = View::forge('fd/booking/create');

	}

	public function action_copy()
	{
		var_dump(Input::post());
		exit;
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('fd/booking');

		if ( ! $fd_booking = Model_Fd_Booking::find($id))
		{
			Session::set_flash('error', 'Could not find booking #'.$id);
			Response::redirect('fd/booking');
		}

		$val = Model_Fd_Booking::validate('edit');

		if ($val->run())
		{
			$fd_booking->reg_no = Input::post('reg_no');
			$fd_booking->folio_no = Input::post('folio_no');
			$fd_booking->room_id = Input::post('room_id');
			$fd_booking->fdesk_user = Input::post('fdesk_user');
			$fd_booking->res_no = Input::post('res_no');
			$fd_booking->status = Input::post('status');
			$fd_booking->checkin = Input::post('checkin');
			$fd_booking->checkout = date('Y-m-d H:i:s', strtotime('+10 hours', strtotime(Input::post('checkout'))));
			$fd_booking->duration = Input::post('duration');
			$fd_booking->pax_adults = Input::post('pax_adults');
			$fd_booking->pax_children = Input::post('pax_children');
			$fd_booking->voucher_no = Input::post('voucher_no');
			$fd_booking->last_name = Input::post('last_name');
			$fd_booking->first_name = Input::post('first_name');
			$fd_booking->sex = Input::post('sex');
			$fd_booking->address = Input::post('address');
			$fd_booking->city = Input::post('city');
			$fd_booking->country = Input::post('country');
			$fd_booking->email = Input::post('email');
			$fd_booking->phone = Input::post('phone');
			$fd_booking->payment_type = Input::post('payment_type');
			$fd_booking->card_type = Input::post('card_type');
			$fd_booking->card_no = Input::post('card_no');
			$fd_booking->card_expire = Input::post('card_expire');
			$fd_booking->rate_type = Input::post('rate_type');
			$fd_booking->rate_amount = Input::post('rate_amount');
			$fd_booking->vat_amount = Input::post('vat_amount');
			$fd_booking->total_amount = Input::post('total_amount');
			$fd_booking->total_charge = Input::post('total_charge');
			$fd_booking->total_payment = Input::post('total_payment');
			$fd_booking->id_type = Input::post('id_type');
			$fd_booking->id_number = Input::post('id_number');
			$fd_booking->id_country = Input::post('id_country');
			$fd_booking->remarks = Input::post('remarks');

			// Calculate all amounts due for duration
			Model_Fd_Booking::setBillingAmounts($fd_booking);

			if ($fd_booking->save())
			{
				// update Invoice and Guest Card
				Model_Sales_Invoice::updateBillDates($fd_booking);
				Model_Sales_Invoice::updateBillSettlement($fd_booking);

				Session::set_flash('success', 'Updated booking #' . $fd_booking->reg_no);

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
				$fd_booking->reg_no = $val->validated('reg_no');
				$fd_booking->folio_no = $val->validated('folio_no');
				$fd_booking->room_id = $val->validated('room_id');
				$fd_booking->fdesk_user = $val->validated('fdesk_user');
				$fd_booking->res_no = $val->validated('res_no');
				$fd_booking->status = $val->validated('status');
				$fd_booking->checkin = $val->validated('checkin');
				$fd_booking->checkout = $val->validated('checkout');
				$fd_booking->duration = $val->validated('duration');
				$fd_booking->pax_adults = $val->validated('pax_adults');
				$fd_booking->pax_children = $val->validated('pax_children');
				$fd_booking->voucher_no = $val->validated('voucher_no');
				$fd_booking->last_name = $val->validated('last_name');
				$fd_booking->first_name = $val->validated('first_name');
				$fd_booking->sex = $val->validated('sex');
				$fd_booking->address = $val->validated('address');
				$fd_booking->city = $val->validated('city');
				$fd_booking->country = $val->validated('country');
				$fd_booking->email = $val->validated('email');
				$fd_booking->phone = $val->validated('phone');
				$fd_booking->payment_type = $val->validated('payment_type');
				$fd_booking->card_type = $val->validated('card_type');
				$fd_booking->card_no = $val->validated('card_no');
				$fd_booking->card_expire = $val->validated('card_expire');
				$fd_booking->rate_type = $val->validated('rate_type');
				$fd_booking->rate_amount = $val->validated('rate_amount');
				$fd_booking->vat_amount = $val->validated('vat_amount');
				$fd_booking->total_amount = $val->validated('total_amount');
				$fd_booking->total_charge = $val->validated('total_charge');
				$fd_booking->total_payment = $val->validated('total_payment');
				$fd_booking->id_type = $val->validated('id_type');
				$fd_booking->id_number = $val->validated('id_number');
				$fd_booking->id_country = $val->validated('id_country');
				$fd_booking->remarks = $val->validated('remarks');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('fd_booking', $fd_booking, false);
		}

		$this->template->title = "Guest Booking";
		$this->template->content = View::forge('fd/booking/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('fd/booking');

		if ($fd_booking = Model_Fd_Booking::find($id))
		{
			try
			{
				// start a db transaction
				// remove related invoice master/detail and cash receipts
				$fd_booking->bill->delete();
				// change room status to avoid orphaned status
				$fd_booking->room->status = Model_Room::ROOM_STATUS_VACANT;
				$fd_booking->room->save();
				// remove booking
				$fd_booking->delete();

				Session::set_flash('success', 'Deleted succeeded #'.$fd_booking->reg_no);

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

		Response::redirect('fd/booking');

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

		$statuses = array(Model_Fd_Booking::GUEST_STATUS_CHECKED_IN, Model_Fd_Booking::GUEST_STATUS_STAY_OVER);
		$bookings = Model_Fd_Booking::find('all', array('where' => array(array('status', 'in', $statuses))));

		foreach ($bookings as $fd_booking)
		{
			$checkin = date('Y-m-d', strtotime($fd_booking->checkin));
			if ($checkin == date('Y-m-d'))
				continue;

			$today = date('Y-m-d');
			$checkout_time = 10;

			$fd_booking->duration = round(abs(strtotime($fd_booking->checkin) - strtotime($today)) / 86400);
			$fd_booking->checkout = date('Y-m-d', strtotime("+{$fd_booking->duration} day", strtotime($fd_booking->checkout)));
			$fd_booking->status = Model_Fd_Booking::GUEST_STATUS_STAY_OVER;
			Model_Fd_Booking::setBillingAmounts($fd_booking);

			if ($fd_booking->save())
				Model_Fd_Booking::updateSalesInvoice($fd_booking);
			else
			{
				$messages[] = $fd_booking->reg_no;
			}
		}

		if (isset($messages))
			Session::set_flash('error', 'Could not convert booking(s) to stay over #'.extract($messages));
		else Session::set_flash('success', "Stayover Guests' bookings and folios have been updated.");

		Response::redirect('dashboard');
	}

	public function action_checkout($id = null)
	{
		is_null($id) and Response::redirect('fd/booking');

		if ( ! $fd_booking = Model_Fd_Booking::find($id))
		{
			Session::set_flash('error', 'Could not find booking #'.$id);
			Response::redirect('fd/booking');
		}
		else {
			// // check if checkout date is reached
			// if (date("Y-m-d", strtotime($fd_booking->checkout)) !== date("Y-m-d", time()))
			// {
			// 	$checkout = date("d/m/Y", strtotime($fd_booking->checkout));
			// 	Session::set_flash('error', "Checkout failed. Due date {$checkout} for checkout is not today.");
			// 	Response::redirect('dashboard');
			// }

			// check if guest bill is fully settled
			if ($fd_booking->bill->balance_due > 0)
			{
				Session::set_flash('error', 'Checkout failed. Guest has outstanding balance for stay period.');

				Response::redirect('cash/receipt/create/'.$fd_booking->bill->id);
			}

			// set guest as checked out
			$fd_booking->status = Model_Fd_Booking::GUEST_STATUS_CHECKED_OUT;

			if ($fd_booking->save())
			{
				Model_Fd_Booking::updateRoomStatus($fd_booking->room_id, $fd_booking->status);
				Model_Sales_Invoice::updateBillStatus($fd_booking);

				Session::set_flash('success', 'Checkout for booking #' . $fd_booking->reg_no . ' complete.');

				Response::redirect('dashboard');
			}

			else
			{
				Session::set_flash('error', 'Checkout for booking #' . $fd_booking->reg_no . ' pending.');
			}
		}

		$this->template->title = "Guest Booking";
		$this->template->content = View::forge('fd/booking/view', $data);

	}

	public function action_rate_list_options()
	{
		$rm_type = Model_Room::find($_GET['id'])->room_type;
		$rates = Model_Rate::find('all', array('where' => array('type_id' => $rm_type)))->to_array();
		echo json_encode($rates);
	}
}
