<?php
class Controller_Hr_Salary_Slip extends Controller_Authenticate
{

	public function action_index()
	{
		$data['hr_salary_slips'] = Model_Hr_Salary_Slip::find('all');
		$this->template->title = "Salary Slips";
		$this->template->content = View::forge('hr/salary/slip/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('hr/salary/slip');

		if ( ! $data['hr_salary_slip'] = Model_Hr_Salary_Slip::find($id))
		{
			Session::set_flash('error', 'Could not find Salary Slip'.$id);
			Response::redirect('hr/salary/slip');
		}

		$this->template->title = "Salary Slip";
		$this->template->content = View::forge('hr/salary/slip/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Hr_Salary_Slip::validate('create');

			if ($val->run())
			{
				$hr_salary_slip = Model_Hr_Salary_Slip::forge(array(
					'code' => Input::post('code'),
					'name' => Input::post('name'),
					'employee_id' => Input::post('employee_id'),
					'designation' => Input::post('designation'),
					'start_date' => Input::post('start_date'),
					'end_date' => Input::post('end_date'),
					'status' => Input::post('status'),
					'date_posted' => Input::post('date_posted'),
					'date_due' => Input::post('date_due'),
					'payroll_period' => Input::post('payroll_period'),
					'total_deductions' => Input::post('total_deductions'),
					'total_earnings' => Input::post('total_earnings'),
					'total_gross' => Input::post('total_gross'),
					'net_amount' => Input::post('net_amount'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($hr_salary_slip and $hr_salary_slip->save())
				{
					Session::set_flash('success', 'Added Salary Slip'.$hr_salary_slip->name.'.');

					Response::redirect('hr/salary/slip');
				}

				else
				{
					Session::set_flash('error', 'Could not save hr_salary_slip.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Salary Slips";
		$this->template->content = View::forge('hr/salary/slip/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('hr/salary/slip');

		if ( ! $hr_salary_slip = Model_Hr_Salary_Slip::find($id))
		{
			Session::set_flash('error', 'Could not find Salary Slip'.$id);
			Response::redirect('hr/salary/slip');
		}

		$val = Model_Hr_Salary_Slip::validate('edit');

		if ($val->run())
		{
			$hr_salary_slip->code = Input::post('code');
			$hr_salary_slip->name = Input::post('name');
			$hr_salary_slip->employee_id = Input::post('employee_id');
			$hr_salary_slip->designation = Input::post('designation');
			$hr_salary_slip->start_date = Input::post('start_date');
			$hr_salary_slip->end_date = Input::post('end_date');
			$hr_salary_slip->status = Input::post('status');
			$hr_salary_slip->date_posted = Input::post('date_posted');
			$hr_salary_slip->date_due = Input::post('date_due');
			$hr_salary_slip->payroll_period = Input::post('payroll_period');
			$hr_salary_slip->total_deductions = Input::post('total_deductions');
			$hr_salary_slip->total_earnings = Input::post('total_earnings');
			$hr_salary_slip->total_gross = Input::post('total_gross');
			$hr_salary_slip->net_amount = Input::post('net_amount');
			$hr_salary_slip->fdesk_user = Input::post('fdesk_user');

			if ($hr_salary_slip->save())
			{
				Session::set_flash('success', 'Updated Salary Slip' . $hr_salary_slip->name);

				Response::redirect('hr/salary/slip');
			}

			else
			{
				Session::set_flash('error', 'Could not update Salary Slip' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$hr_salary_slip->code = $val->validated('code');
				$hr_salary_slip->name = $val->validated('name');
				$hr_salary_slip->employee_id = $val->validated('employee_id');
				$hr_salary_slip->designation = $val->validated('designation');
				$hr_salary_slip->start_date = $val->validated('start_date');
				$hr_salary_slip->end_date = $val->validated('end_date');
				$hr_salary_slip->status = $val->validated('status');
				$hr_salary_slip->date_posted = $val->validated('date_posted');
				$hr_salary_slip->date_due = $val->validated('date_due');
				$hr_salary_slip->payroll_period = $val->validated('payroll_period');
				$hr_salary_slip->total_deductions = $val->validated('total_deductions');
				$hr_salary_slip->total_earnings = $val->validated('total_earnings');
				$hr_salary_slip->total_gross = $val->validated('total_gross');
				$hr_salary_slip->net_amount = $val->validated('net_amount');
				$hr_salary_slip->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('hr_salary_slip', $hr_salary_slip, false);
		}

		$this->template->title = "Salary Slips";
		$this->template->content = View::forge('hr/salary/slip/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('hr/salary/slip');

		if ($hr_salary_slip = Model_Hr_Salary_Slip::find($id))
		{
			$hr_salary_slip->delete();

			Session::set_flash('success', 'Deleted Salary Slip'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete Salary Slip'.$id);
		}

		Response::redirect('hr/salary/slip');

	}

}
