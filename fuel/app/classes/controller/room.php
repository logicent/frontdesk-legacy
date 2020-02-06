<?php
class Controller_Room extends Controller_Authenticate{

	public function action_index()
	{
		$data['room'] = Model_Room::find('all', array('related' => 'rm_type'));
		$this->template->title = "Room";
		$this->template->content = View::forge('room/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('room');

		if ( ! $data['room'] = Model_Room::find($id))
		{
			Session::set_flash('error', 'Could not find room #'.$id);
			Response::redirect('room');
		}

		$this->template->title = "Room";
		$this->template->content = View::forge('room/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Room::validate('create');

			if ($val->run())
			{
				$room = Model_Room::forge(array(
					'name' => Input::post('name'),
					'room_type' => Input::post('room_type'),
					'alias' => Input::post('alias'),
					'status' => Input::post('status'),
					'hk_status' => Input::post('hk_status'),
				));

				if ($room and $room->save())
				{
					Session::set_flash('success', 'Added room #'.$room->name.'.');

					Response::redirect('room');
				}

				else
				{
					Session::set_flash('error', 'Could not save room.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Room";
		$this->template->content = View::forge('room/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('room');

		if ( ! $room = Model_Room::find($id))
		{
			Session::set_flash('error', 'Could not find room #'.$id);
			Response::redirect('room');
		}

		$val = Model_Room::validate('edit');

		if ($val->run())
		{
			$room->name = Input::post('name');
			$room->room_type = Input::post('room_type');
			$room->alias = Input::post('alias');
			$room->status = Input::post('status');
			$room->hk_status = Input::post('hk_status');

			if ($room->save())
			{
				Session::set_flash('success', 'Updated room #' . $id);

				Response::redirect('room');
			}

			else
			{
				Session::set_flash('error', 'Could not update room #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$room->name = $val->validated('name');
				$room->room_type = $val->validated('room_type');
				$room->alias = $val->validated('alias');
				$room->status = $val->validated('status');
				$room->hk_status = $val->validated('hk_status');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('room', $room, false);
		}

		$this->template->title = "Room";
		$this->template->content = View::forge('room/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('room');

		if ($room = Model_Room::find($id))
		{
			$booking = Model_Facility_Booking::find('first', array('where' => array('room_id' => $id)));
			if ($booking)
				Session::set_flash('error', 'Can not delete Room used in booking(s).');
			else
			{
				$room->delete();
				Session::set_flash('success', 'Deleted room #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Could not delete room #'.$id);
		}

		Response::redirect('room');

	}

	public function action_unblock($id = null)
	{
		is_null($id) and Response::redirect('room');

		if ($room = Model_Room::find($id))
		{
			$room->status = Model_Room::ROOM_STATUS_VACANT;
			$room->save();

			Session::set_flash('success', 'Room #'.$room->name.' is unblocked.');
		}

		else
		{
			Session::set_flash('error', 'Could not unblock room #'.$id);
		}

		Response::redirect('dashboard');

	}
}
