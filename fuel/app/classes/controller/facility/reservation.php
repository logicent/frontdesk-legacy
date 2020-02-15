<?php

class Controller_Facility_Reservation extends Controller_Authenticate
{
	public function action_index($show_del = false)
	{
		if ($show_del)
			$data['reservation'] = Model_Facility_Reservation::deleted('all');
		else
		{
			$status = Input::get('status');
			if (!$status)
				$status = Model_Facility_Reservation::RESERVATION_STATUS_OPEN;

			$data['reservation'] = Model_Facility_Reservation::find('all', array('where' => array(
				array('status', '=', $status)), 'order_by' => array('res_no' => 'desc'), 'limit' => 1000));
		}

		$data['status'] = $status;

		$this->template->title = "Guest Reservations";
		$this->template->content = View::forge('facility/reservation/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('registers/reservations');

		if ( ! $data['reservation'] = Model_Facility_Reservation::find($id))
		{
			Session::set_flash('error', 'Could not find reservation #'.$id);
			Response::redirect('registers/reservations');
		}

		$this->template->title = "Reservation";
		$this->template->content = View::forge('facility/reservation/view', $data);

	}

	public function action_create($rm_id = null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Facility_Reservation::validate('create');

			if ($val->run())
			{
				$reservation = Model_Facility_Reservation::forge(array(
					'res_no' => Input::post('res_no'),
					'unit_id' => Input::post('unit_id'),
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
					if ($reservation and $reservation->save())
					{
						Session::set_flash('success', 'Added reservation #'.$reservation->id.'.');
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

		$room = Model_Unit::find($rm_id);
		$this->template->set_global('room', $room, false);

		$this->template->title = "Reservation";
		$this->template->content = View::forge('facility/reservation/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('registers/reservations');

		if ( ! $reservation = Model_Facility_Reservation::find($id))
		{
			Session::set_flash('error', 'Could not find reservation #'.$id);
			Response::redirect('registers/reservations');
		}

		$val = Model_Facility_Reservation::validate('edit');

		if ($val->run())
		{
			$reservation->res_no = Input::post('res_no');
			$reservation->unit_id = Input::post('unit_id');
			$reservation->fdesk_user = Input::post('fdesk_user');
			$reservation->status = Input::post('status');
			$reservation->checkin = Input::post('checkin');
			$reservation->checkout = Input::post('checkout');
			$reservation->duration = Input::post('duration');
			$reservation->pax_adults = Input::post('pax_adults');
			$reservation->pax_children = Input::post('pax_children');
			$reservation->voucher_no = Input::post('voucher_no');
			$reservation->last_name = Input::post('last_name');
			$reservation->first_name = Input::post('first_name');
			$reservation->address = Input::post('address');
			$reservation->city = Input::post('city');
			$reservation->country = Input::post('country');
			$reservation->email = Input::post('email');
			$reservation->phone = Input::post('phone');
			$reservation->rate_type = Input::post('rate_type');
			$reservation->id_type = Input::post('id_type');
			$reservation->id_number = Input::post('id_number');
			$reservation->id_country = Input::post('id_country');
			$reservation->remarks = Input::post('remarks');

			if ($reservation->save())
			{
				Session::set_flash('success', 'Updated reservation #' . $id);

				Response::redirect('registers/reservations');
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
				$reservation->res_no = $val->validated('res_no');
				$reservation->unit_id = $val->validated('unit_id');
				$reservation->fdesk_user = $val->validated('fdesk_user');
				$reservation->status = $val->validated('status');
				$reservation->checkin = $val->validated('checkin');
				$reservation->checkout = $val->validated('checkout');
				$reservation->duration = $val->validated('duration');
				$reservation->pax_adults = $val->validated('pax_adults');
				$reservation->pax_children = $val->validated('pax_children');
				$reservation->voucher_no = $val->validated('voucher_no');
				$reservation->last_name = $val->validated('last_name');
				$reservation->first_name = $val->validated('first_name');
				$reservation->address = $val->validated('address');
				$reservation->city = $val->validated('city');
				$reservation->country = $val->validated('country');
				$reservation->email = $val->validated('email');
				$reservation->phone = $val->validated('phone');
				$reservation->rate_type = $val->validated('rate_type');
				$reservation->id_type = $val->validated('id_type');
				$reservation->id_number = $val->validated('id_number');
				$reservation->id_country = $val->validated('id_country');
				$reservation->remarks = $val->validated('remarks');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('reservation', $reservation, false);
		}

		$this->template->title = "Reservation";
		$this->template->content = View::forge('facility/reservation/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('registers/reservations');

		if ($reservation = Model_Facility_Reservation::find($id))
		{
			try {
				// delete relations
				$reservation->delete();
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

		Response::redirect('registers/reservations');

	}

    public function action_list_by($room = null)
	{
        $room = Input::get('room');
        
        $data['reservation'] = Model_Facility_Reservation::find('all', 
            array(
                'where' => 
                    array(
                        array('status', '=', 'Open'),
                        'unit_id' => $room
                    ), 
                'order_by' => array('res_no' => 'desc'), 
                'limit' => 1000
            )
        );
        
		$this->template->title = "Guest Reservations";
		$this->template->content = View::forge('facility/reservation/index', $data);

	}

	public function action_confirm($id = null)
	{
		echo "Not implemented yet";
		exit;
	}

}
