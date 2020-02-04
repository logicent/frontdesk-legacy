<?php
class Controller_Facility_Facility extends Controller_Authenticate
{

	public function action_index()
	{
		$data['facilities'] = Model_Facility_Facility::find('all');
		$this->template->title = "Facilities";
		$this->template->content = View::forge('facility/facility/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facility/facility');

		if ( ! $data['facility'] = Model_Facility_Facility::find($id))
		{
			Session::set_flash('error', 'Could not find facility #'.$id);
			Response::redirect('facility/facility');
		}

		$this->template->title = "Facility";
		$this->template->content = View::forge('facility/facility/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Facility_Facility::validate('create');

			if ($val->run())
			{
				$facility = Model_Facility_Facility::forge(array(
				));

				if ($facility and $facility->save())
				{
					Session::set_flash('success', 'Added facility #'.$facility->id.'.');

					Response::redirect('facility/facility');
				}

				else
				{
					Session::set_flash('error', 'Could not save facility.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Facilities";
		$this->template->content = View::forge('facility/facility/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facility/facility');

		if ( ! $facility = Model_Facility_Facility::find($id))
		{
			Session::set_flash('error', 'Could not find facility #'.$id);
			Response::redirect('facility/facility');
		}

		$val = Model_Facility_Facility::validate('edit');

		if ($val->run())
		{

			if ($facility->save())
			{
				Session::set_flash('success', 'Updated facility #' . $id);

				Response::redirect('facility/facility');
			}

			else
			{
				Session::set_flash('error', 'Could not update facility #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('facility', $facility, false);
		}

		$this->template->title = "Facilities";
		$this->template->content = View::forge('facility/facility/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facility/facility');

		if ($facility = Model_Facility_Facility::find($id))
		{
			$facility->delete();

			Session::set_flash('success', 'Deleted facility #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete facility #'.$id);
		}

		Response::redirect('facility/facility');

	}

}
