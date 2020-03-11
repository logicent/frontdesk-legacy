<?php
class Controller_Hr_Employment_Type extends Controller_Authenticate
{

	public function action_index()
	{
		$data['hr_employment_types'] = Model_Hr_Employment_Type::find('all');
		$this->template->title = "Employment Types";
		$this->template->content = View::forge('hr/employment/type/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('hr/employment/type');

		if ( ! $data['employment_type'] = Model_Hr_Employment_Type::find($id))
		{
			Session::set_flash('error', 'Could not find Employment type'.$id);
			Response::redirect('hr/employment/type');
		}

		$this->template->title = "Employment Type";
		$this->template->content = View::forge('hr/employment/type/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Hr_Employment_Type::validate('create');

			if ($val->run())
			{
				$employment_type = Model_Hr_Employment_Type::forge(array(
					'code' => Input::post('code'),
					'description' => Input::post('description'),
					'enabled' => Input::post('enabled'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($employment_type and $employment_type->save())
				{
					Session::set_flash('success', 'Added Employment type'.$employment_type->description.'.');

					Response::redirect('hr/employment/type');
				}

				else
				{
					Session::set_flash('error', 'Could not save hr_employment_type.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Employment Types";
		$this->template->content = View::forge('hr/employment/type/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('hr/employment/type');

		if ( ! $employment_type = Model_Hr_Employment_Type::find($id))
		{
			Session::set_flash('error', 'Could not find Employment type'.$id);
			Response::redirect('hr/employment/type');
		}

		$val = Model_Hr_Employment_Type::validate('edit');

		if ($val->run())
		{
			$employment_type->code = Input::post('code');
			$employment_type->description = Input::post('description');
			$employment_type->enabled = Input::post('enabled');
			$employment_type->fdesk_user = Input::post('fdesk_user');

			if ($employment_type->save())
			{
				Session::set_flash('success', 'Updated Employment type' . $employment_type->description);

				Response::redirect('hr/employment/type');
			}

			else
			{
				Session::set_flash('error', 'Could not update Employment type' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$employment_type->code = $val->validated('code');
				$employment_type->description = $val->validated('description');
				$employment_type->enabled = $val->validated('enabled');
				$employment_type->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('employment_type', $employment_type, false);
		}

		$this->template->title = "Employment Types";
		$this->template->content = View::forge('hr/employment/type/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('hr/employment/type');

		if ($employment_type = Model_Hr_Employment_Type::find($id))
		{
			$employment_type->delete();

			Session::set_flash('success', 'Deleted Employment type'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete Employment type'.$id);
		}

		Response::redirect('hr/employment/type');

	}

}
