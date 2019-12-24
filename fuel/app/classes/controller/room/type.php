<?php
class Controller_Room_Type extends Controller_Authenticate{

	public function action_index()
	{
		$data['room_type'] = Model_Room_Type::find('all');
		$this->template->title = "Room Type";
		$this->template->content = View::forge('room/type/index', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Room_Type::validate('create');

			if ($val->run())
			{
				$room_type = Model_Room_Type::forge(array(
					'name' => Input::post('name'),
					'description' => Input::post('description'),
				));

				if ($room_type and $room_type->save())
				{
					Session::set_flash('success', 'Added room type #'.$room_type->name.'.');

					Response::redirect('room/type');
				}

				else
				{
					Session::set_flash('error', 'Could not save room type.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Room Type";
		$this->template->content = View::forge('room/type/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('room/type');

		if ( ! $room_type = Model_Room_Type::find($id))
		{
			Session::set_flash('error', 'Could not find room type #'.$id);
			Response::redirect('room/type');
		}

		$val = Model_Room_Type::validate('edit');

		if ($val->run())
		{
			$room_type->name = Input::post('name');
			$room_type->description = Input::post('description');

			if ($room_type->save())
			{
				Session::set_flash('success', 'Updated room type #' . $id);

				Response::redirect('room/type');
			}

			else
			{
				Session::set_flash('error', 'Could not update room type #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$room_type->name = $val->validated('name');
				$room_type->description = $val->validated('description');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('room_type', $room_type, false);
		}

		$this->template->title = "Room Type";
		$this->template->content = View::forge('room/type/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('room/type');

		if ($room_type = Model_Room_Type::find($id))
		{
			$room = Model_Room::find('first', array('where' => array('room_type' => $id)));
			if ($room)
				Session::set_flash('error', 'Room type is already in use by Room(s).');
			else
			{
				$room_type->delete();
				Session::set_flash('success', 'Deleted room type #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Could not delete room type #'.$id);
		}

		Response::redirect('room/type');

	}

}
