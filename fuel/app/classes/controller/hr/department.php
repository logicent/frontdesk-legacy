<?php
class Controller_Hr_Department extends Controller_Authenticate
{

	public function action_index()
	{
		$data['hr_departments'] = Model_Hr_Department::find('all');
		$this->template->title = "Departments";
		$this->template->content = View::forge('hr/department/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('hr/department');

		if ( ! $data['hr_department'] = Model_Hr_Department::find($id))
		{
			Session::set_flash('error', 'Could not find HR Department #'.$id);
			Response::redirect('hr/department');
		}

		$this->template->title = "Department";
		$this->template->content = View::forge('hr/department/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Hr_Department::validate('create');

			if ($val->run())
			{
				$hr_department = Model_Hr_Department::forge(array(
					'code' => Input::post('code'),
					'name' => Input::post('name'),
					'enabled' => Input::post('enabled'),
					'parent_id' => Input::post('parent_id'),
					'fdesk_user' => Input::post('fdesk_user'),
				));
				// use observer in model instead
				if (!$hr_department->parent_id)
					$hr_department->parent_id = null;
				
				if ($hr_department and $hr_department->save())
				{
					Session::set_flash('success', 'Added HR Department #'.$hr_department->name.'.');

					Response::redirect('hr/department');
				}

				else
				{
					Session::set_flash('error', 'Could not save HR Department.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Departments";
		$this->template->content = View::forge('hr/department/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('hr/department');

		if ( ! $hr_department = Model_Hr_Department::find($id))
		{
			Session::set_flash('error', 'Could not find HR Department #'.$id);
			Response::redirect('hr/department');
		}

		$val = Model_Hr_Department::validate('edit');

		if ($val->run())
		{
			$hr_department->code = Input::post('code');
			$hr_department->name = Input::post('name');
			$hr_department->enabled = Input::post('enabled');
			$hr_department->parent_id = Input::post('parent_id');
			$hr_department->fdesk_user = Input::post('fdesk_user');

			if ($hr_department->save())
			{
				Session::set_flash('success', 'Updated HR Department #' . $id);

				Response::redirect('hr/department');
			}

			else
			{
				Session::set_flash('error', 'Could not update HR Department #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$hr_department->code = $val->validated('code');
				$hr_department->name = $val->validated('name');
				$hr_department->enabled = $val->validated('enabled');
				$hr_department->parent_id = $val->validated('parent_id');
				$hr_department->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('hr_department', $hr_department, false);
		}

		$this->template->title = "Departments";
		$this->template->content = View::forge('hr/department/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('hr/department');

        if (Input::method() == 'POST')
		{		
			if ($hr_department = Model_Hr_Department::find($id))
			{
				$hr_department->delete();

				Session::set_flash('success', 'Deleted HR Department #'.$id);
			}

			else
			{
				Session::set_flash('error', 'Could not delete HR Department #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}
		
		Response::redirect('hr/department');

	}

}
