<?php
class Controller_Fd_Reservation extends Controller_Authenticate{

	public function action_index($show_del = false)
	{
		if ($show_del)
			$data['fd_reservation'] = Model_Fd_Reservation::deleted('all');
		else
		{
			$status = Input::get('status');
			if (!$status)
				$status = Model_Fd_Reservation::RESERVATION_STATUS_OPEN;

			$data['fd_reservation'] = Model_Fd_Reservation::find('all', array('where' => array(
				array('status', '=', $status)), 'order_by' => array('res_no' => 'desc'), 'limit' => 1000));
		}

		$data['status'] = $status;

		$this->template->title = "Guest Reservations";
		$this->template->content = View::forge('fd/reservation/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('fd/reservation');

		if ( ! $data['fd_reservation'] = Model_Fd_Reservation::find($id))
		{
			Session::set_flash('error', 'Could not find reservation #'.$id);
			Response::redirect('fd/reservation');
		}

		$this->template->title = "Reservation";
		$this->template->content = View::forge('fd/reservation/view', $data);

	}

	public function action_create($rm_id = null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Fd_Reservation::validate('create');

			if ($val->run())
			{
				$fd_reservation = Model_Fd_Reservation::forge(array(
					'res_no' => Input::post('res_no'),
					'room_id' => Input::post('room_id'),
					'fdesk_user' => Input::post('fdesk_user'),
					'status' => Input::post('status'),
					'checkin' => Input::post('checkin'),
					'checkout' => Input::post('checkout'),
					'duration' => Input::post('duration'),
					'pax_adults' => Input::post('pax_adults'),
					'pax_children' => Input::post('pax_children'),
					'voucher_no' => Input::post('voucher_no'),
					'last_name' => Input::post('last_name'),
					'first_name' => Input::post('first_name'),
					'address' => Input::post('address'),
					'city' => Input::post('city'),
					'country' => Input::post('country'),
					'email' => Input::post('email'),
					'phone' => Input::post('phone'),
					'rate_type' => Input::post('rate_type'),
					'id_type' => Input::post('id_type'),
					'id_number' => Input::post('id_number'),
					'id_country' => Input::post('id_country'),
					'remarks' => Input::post('remarks'),
				));

				try {
					if ($fd_reservation and $fd_reservation->save())
					{
						Session::set_flash('success', 'Added reservation #'.$fd_reservation->id.'.');
						Response::redirect('dashboard');
					}
				}
				catch (Fuel\Core\Database_exception $e)
				{
					Session::set_flash('error', $e->getMessage());
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$room = Model_Room::find($rm_id);
		$this->template->set_global('room', $room, false);

		$this->template->title = "Reservation";
		$this->template->content = View::forge('fd/reservation/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('fd/reservation');

		if ( ! $fd_reservation = Model_Fd_Reservation::find($id))
		{
			Session::set_flash('error', 'Could not find reservation #'.$id);
			Response::redirect('fd/reservation');
		}

		$val = Model_Fd_Reservation::validate('edit');

		if ($val->run())
		{
			$fd_reservation->res_no = Input::post('res_no');
			$fd_reservation->room_id = Input::post('room_id');
			$fd_reservation->fdesk_user = Input::post('fdesk_user');
			$fd_reservation->status = Input::post('status');
			$fd_reservation->checkin = Input::post('checkin');
			$fd_reservation->checkout = Input::post('checkout');
			$fd_reservation->duration = Input::post('duration');
			$fd_reservation->pax_adults = Input::post('pax_adults');
			$fd_reservation->pax_children = Input::post('pax_children');
			$fd_reservation->voucher_no = Input::post('voucher_no');
			$fd_reservation->last_name = Input::post('last_name');
			$fd_reservation->first_name = Input::post('first_name');
			$fd_reservation->address = Input::post('address');
			$fd_reservation->city = Input::post('city');
			$fd_reservation->country = Input::post('country');
			$fd_reservation->email = Input::post('email');
			$fd_reservation->phone = Input::post('phone');
			$fd_reservation->rate_type = Input::post('rate_type');
			$fd_reservation->id_type = Input::post('id_type');
			$fd_reservation->id_number = Input::post('id_number');
			$fd_reservation->id_country = Input::post('id_country');
			$fd_reservation->remarks = Input::post('remarks');

			if ($fd_reservation->save())
			{
				Session::set_flash('success', 'Updated reservation #' . $id);

				Response::redirect('fd/reservation');
			}

			else
			{
				Session::set_flash('error', 'Could not update reservation #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$fd_reservation->res_no = $val->validated('res_no');
				$fd_reservation->room_id = $val->validated('room_id');
				$fd_reservation->fdesk_user = $val->validated('fdesk_user');
				$fd_reservation->status = $val->validated('status');
				$fd_reservation->checkin = $val->validated('checkin');
				$fd_reservation->checkout = $val->validated('checkout');
				$fd_reservation->duration = $val->validated('duration');
				$fd_reservation->pax_adults = $val->validated('pax_adults');
				$fd_reservation->pax_children = $val->validated('pax_children');
				$fd_reservation->voucher_no = $val->validated('voucher_no');
				$fd_reservation->last_name = $val->validated('last_name');
				$fd_reservation->first_name = $val->validated('first_name');
				$fd_reservation->address = $val->validated('address');
				$fd_reservation->city = $val->validated('city');
				$fd_reservation->country = $val->validated('country');
				$fd_reservation->email = $val->validated('email');
				$fd_reservation->phone = $val->validated('phone');
				$fd_reservation->rate_type = $val->validated('rate_type');
				$fd_reservation->id_type = $val->validated('id_type');
				$fd_reservation->id_number = $val->validated('id_number');
				$fd_reservation->id_country = $val->validated('id_country');
				$fd_reservation->remarks = $val->validated('remarks');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('fd_reservation', $fd_reservation, false);
		}

		$this->template->title = "Reservation";
		$this->template->content = View::forge('fd/reservation/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('fd/reservation');

		if ($fd_reservation = Model_Fd_Reservation::find($id))
		{
			try {
				// delete relations
				$fd_reservation->delete();
			}
			catch (FuelException $e)
			{
				Session::set_flash('error', 'Could not delete reservation relations #' . $id);
			}
			Session::set_flash('success', 'Deleted reservation #'.$id);
		}
		else
		{
			Session::set_flash('error', 'Could not delete reservation #'.$id);
		}

		Response::redirect('fd/reservation');

	}

	public function action_confirm($id = null)
	{
		echo "Not implemented yet";
		exit;
	}

}
