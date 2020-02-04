<?php
class Controller_Facility_Unit extends Controller_Authenticate
{

	public function action_index()
	{
		$data['units'] = Model_Facility_Unit::find('all');
		$this->template->title = "Units";
		$this->template->content = View::forge('facility/unit/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facility/unit');

		if ( ! $data['unit'] = Model_Facility_Unit::find($id))
		{
			Session::set_flash('error', 'Could not find unit #'.$id);
			Response::redirect('facility/unit');
		}

		$this->template->title = "Unit";
		$this->template->content = View::forge('facility/unit/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Facility_Unit::validate('create');

			if ($val->run())
			{
				$unit = Model_Facility_Unit::forge(array(
				));

				if ($unit and $unit->save())
				{
					Session::set_flash('success', 'Added unit #'.$unit->id.'.');

					Response::redirect('facility/unit');
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

		$this->template->title = "Units";
		$this->template->content = View::forge('facility/unit/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facility/unit');

		if ( ! $unit = Model_Facility_Unit::find($id))
		{
			Session::set_flash('error', 'Could not find unit #'.$id);
			Response::redirect('facility/unit');
		}

		$val = Model_Facility_Unit::validate('edit');

		if ($val->run())
		{

			if ($unit->save())
			{
				Session::set_flash('success', 'Updated unit #' . $id);

				Response::redirect('facility/unit');
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

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('unit', $unit, false);
		}

		$this->template->title = "Units";
		$this->template->content = View::forge('facility/unit/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facility/unit');

		if ($unit = Model_Facility_Unit::find($id))
		{
			$unit->delete();

			Session::set_flash('success', 'Deleted unit #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete unit #'.$id);
		}

		Response::redirect('facility/unit');

	}

}
