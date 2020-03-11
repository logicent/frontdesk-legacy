<?php
class Controller_Hr_Salary_Component extends Controller_Authenticate
{

	public function action_index()
	{
		$data['hr_salary_components'] = Model_Hr_Salary_Component::find('all');
		$this->template->title = "Salary Components";
		$this->template->content = View::forge('hr/salary/component/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('hr/salary/component');

		if ( ! $data['hr_salary_component'] = Model_Hr_Salary_Component::find($id))
		{
			Session::set_flash('error', 'Could not find salary component'.$id);
			Response::redirect('hr/salary/component');
		}

		$this->template->title = "Salary Component";
		$this->template->content = View::forge('hr/salary/component/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Hr_Salary_Component::validate('create');

			if ($val->run())
			{
				$hr_salary_component = Model_Hr_Salary_Component::forge(array(
					'code' => Input::post('code'),
					'name' => Input::post('name'),
					'description' => Input::post('description'),
					'enabled' => Input::post('enabled'),
					'is_payable' => Input::post('is_payable'),
					'is_tax_applicable' => Input::post('is_tax_applicable'),
					'depends_on_payment_days' => Input::post('depends_on_payment_days'),
					'type' => Input::post('type'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($hr_salary_component and $hr_salary_component->save())
				{
					Session::set_flash('success', 'Added salary component'.$hr_salary_component->name.'.');

					Response::redirect('hr/salary/component');
				}

				else
				{
					Session::set_flash('error', 'Could not save hr_salary_component.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Salary Components";
		$this->template->content = View::forge('hr/salary/component/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('hr/salary/component');

		if ( ! $hr_salary_component = Model_Hr_Salary_Component::find($id))
		{
			Session::set_flash('error', 'Could not find salary component'.$id);
			Response::redirect('hr/salary/component');
		}

		$val = Model_Hr_Salary_Component::validate('edit');

		if ($val->run())
		{
			$hr_salary_component->code = Input::post('code');
			$hr_salary_component->name = Input::post('name');
			$hr_salary_component->description = Input::post('description');
			$hr_salary_component->enabled = Input::post('enabled');
			$hr_salary_component->is_payable = Input::post('is_payable');
			$hr_salary_component->is_tax_applicable = Input::post('is_tax_applicable');
			$hr_salary_component->depends_on_payment_days = Input::post('depends_on_payment_days');
			$hr_salary_component->type = Input::post('type');
			$hr_salary_component->fdesk_user = Input::post('fdesk_user');

			if ($hr_salary_component->save())
			{
				Session::set_flash('success', 'Updated salary component' . $hr_salary_component->name);

				Response::redirect('hr/salary/component');
			}

			else
			{
				Session::set_flash('error', 'Could not update salary component' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$hr_salary_component->code = $val->validated('code');
				$hr_salary_component->name = $val->validated('name');
				$hr_salary_component->description = $val->validated('description');
				$hr_salary_component->enabled = $val->validated('enabled');
				$hr_salary_component->is_payable = $val->validated('is_payable');
				$hr_salary_component->is_tax_applicable = $val->validated('is_tax_applicable');
				$hr_salary_component->depends_on_payment_days = $val->validated('depends_on_payment_days');
				$hr_salary_component->type = $val->validated('type');
				$hr_salary_component->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('hr_salary_component', $hr_salary_component, false);
		}

		$this->template->title = "Salary Components";
		$this->template->content = View::forge('hr/salary/component/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('hr/salary/component');

		if ($hr_salary_component = Model_Hr_Salary_Component::find($id))
		{
			$hr_salary_component->delete();

			Session::set_flash('success', 'Deleted salary component'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete salary component'.$id);
		}

		Response::redirect('hr/salary/component');

	}

}
