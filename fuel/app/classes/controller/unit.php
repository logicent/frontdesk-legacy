<?php
class Controller_Unit extends Controller_Authenticate{

	public function action_index()
	{
		$data['unit'] = Model_Unit::find('all', array('related' => 'type'));
		$this->template->title = "Unit";
		$this->template->content = View::forge('unit/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facilities/units');

		if ( ! $data['unit'] = Model_Unit::find($id))
		{
			Session::set_flash('error', 'Could not find unit #'.$id);
			Response::redirect('facilities/units');
		}

		$this->template->title = "Unit";
		$this->template->content = View::forge('unit/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Unit::validate('create');

			if ($val->run())
			{
				$unit = Model_Unit::forge(array(
					'name' => Input::post('name'),
					'unit_type' => Input::post('unit_type'),
					'prefix' => Input::post('prefix'),
					'status' => Input::post('status'),
                    'hk_status' => Input::post('hk_status'),
                    'fdesk_user' => Input::post('fdesk_user'),
                    
				));

				if ($unit and $unit->save())
				{
					Session::set_flash('success', 'Added unit #'.$unit->name.'.');

					Response::redirect('facilities/units');
				}

				else
				{
					Session::set_flash('error', 'Could not save unit.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Unit";
		$this->template->content = View::forge('unit/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facilities/units');

		if ( ! $unit = Model_Unit::find($id))
		{
			Session::set_flash('error', 'Could not find unit #'.$id);
			Response::redirect('facilities/units');
		}

		$val = Model_Unit::validate('edit');

		if ($val->run())
		{
			$unit->name = Input::post('name');
			$unit->unit_type = Input::post('unit_type');
			$unit->prefix = Input::post('prefix');
			$unit->status = Input::post('status');
			$unit->hk_status = Input::post('hk_status');
            $unit->fdesk_user = Input::post('fdesk_user');

			if ($unit->save())
			{
				Session::set_flash('success', 'Updated unit #' . $id);

				Response::redirect('facilities/units');
			}

			else
			{
				Session::set_flash('error', 'Could not update unit #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$unit->name = $val->validated('name');
				$unit->unit_type = $val->validated('unit_type');
				$unit->prefix = $val->validated('prefix');
				$unit->status = $val->validated('status');
				$unit->hk_status = $val->validated('hk_status');
                $unit->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('unit', $unit, false);
		}

		$this->template->title = "Unit";
		$this->template->content = View::forge('unit/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facilities/units');

		if ($unit = Model_Unit::find($id))
		{
			$booking = Model_Facility_Booking::find('first', array('where' => array('unit_id' => $id)));
			if ($booking)
				Session::set_flash('error', 'Can not delete Unit used in booking(s).');
			else
			{
				$unit->delete();
				Session::set_flash('success', 'Deleted unit #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Could not delete unit #'.$id);
		}

		Response::redirect('facilities/units');

	}

	public function action_unblock($id = null)
	{
		is_null($id) and Response::redirect('facilities/units');

		if ($unit = Model_Unit::find($id))
		{
			$unit->status = Model_Unit::UNIT_STATUS_VACANT;
			$unit->save();

			Session::set_flash('success', 'Unit #'.$unit->name.' is unblocked.');
		}

		else
		{
			Session::set_flash('error', 'Could not unblock unit #'.$id);
		}

		Response::redirect('dashboard');

	}
}
