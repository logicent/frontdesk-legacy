<?php
class Controller_Hr_Designation extends Controller_Authenticate
{

	public function action_index()
	{
		$data['hr_designations'] = Model_Hr_Designation::find('all');
		$this->template->title = "Hr_designations";
		$this->template->content = View::forge('hr/designation/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('hr/designation');

		if ( ! $data['hr_designation'] = Model_Hr_Designation::find($id))
		{
			Session::set_flash('error', 'Could not find hr_designation #'.$id);
			Response::redirect('hr/designation');
		}

		$this->template->title = "Hr_designation";
		$this->template->content = View::forge('hr/designation/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Hr_Designation::validate('create');

			if ($val->run())
			{
				$hr_designation = Model_Hr_Designation::forge(array(
					'code' => Input::post('code'),
					'name' => Input::post('name'),
					'description' => Input::post('description'),
					'enabled' => Input::post('enabled'),
					'reports_to' => Input::post('reports_to'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				// use observer in model instead
				if (!$hr_designation->reports_to)
					$hr_designation->reports_to = null;

				if ($hr_designation and $hr_designation->save())
				{
					Session::set_flash('success', 'Added hr_designation #'.$hr_designation->id.'.');

					Response::redirect('hr/designation');
				}

				else
				{
					Session::set_flash('error', 'Could not save hr_designation.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Hr_designations";
		$this->template->content = View::forge('hr/designation/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('hr/designation');

		if ( ! $hr_designation = Model_Hr_Designation::find($id))
		{
			Session::set_flash('error', 'Could not find hr_designation #'.$id);
			Response::redirect('hr/designation');
		}

		$val = Model_Hr_Designation::validate('edit');

		if ($val->run())
		{
			$hr_designation->code = Input::post('code');
			$hr_designation->name = Input::post('name');
			$hr_designation->description = Input::post('description');
			$hr_designation->enabled = Input::post('enabled');
			$hr_designation->reports_to = Input::post('reports_to');
			$hr_designation->fdesk_user = Input::post('fdesk_user');

			if ($hr_designation->save())
			{
				Session::set_flash('success', 'Updated hr_designation #' . $id);

				Response::redirect('hr/designation');
			}

			else
			{
				Session::set_flash('error', 'Could not update hr_designation #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$hr_designation->code = $val->validated('code');
				$hr_designation->name = $val->validated('name');
				$hr_designation->description = $val->validated('description');
				$hr_designation->enabled = $val->validated('enabled');
				$hr_designation->reports_to = $val->validated('reports_to');
				$hr_designation->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('hr_designation', $hr_designation, false);
		}

		$this->template->title = "Hr_designations";
		$this->template->content = View::forge('hr/designation/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('hr/designation');

		if ($hr_designation = Model_Hr_Designation::find($id))
		{
			$hr_designation->delete();

			Session::set_flash('success', 'Deleted hr_designation #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete hr_designation #'.$id);
		}

		Response::redirect('hr/designation');

	}

}
