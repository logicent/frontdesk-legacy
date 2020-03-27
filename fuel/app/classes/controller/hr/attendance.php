<?php
class Controller_Hr_Attendance extends Controller_Template
{

	public function action_index()
	{
		$data['hr_attendances'] = Model_Hr_Attendance::find('all');
		$this->template->title = "Hr_attendances";
		$this->template->content = View::forge('hr/attendance/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('hr/attendance');

		if ( ! $data['hr_attendance'] = Model_Hr_Attendance::find($id))
		{
			Session::set_flash('error', 'Could not find hr_attendance #'.$id);
			Response::redirect('hr/attendance');
		}

		$this->template->title = "Hr_attendance";
		$this->template->content = View::forge('hr/attendance/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Hr_Attendance::validate('create');

			if ($val->run())
			{
				$hr_attendance = Model_Hr_Attendance::forge(array(
					'employee_id' => Input::post('employee_id'),
					'work_day' => Input::post('work_day'),
					'status' => Input::post('status'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($hr_attendance and $hr_attendance->save())
				{
					Session::set_flash('success', 'Added hr_attendance #'.$hr_attendance->id.'.');

					Response::redirect('hr/attendance');
				}

				else
				{
					Session::set_flash('error', 'Could not save hr_attendance.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Hr_attendances";
		$this->template->content = View::forge('hr/attendance/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('hr/attendance');

		if ( ! $hr_attendance = Model_Hr_Attendance::find($id))
		{
			Session::set_flash('error', 'Could not find hr_attendance #'.$id);
			Response::redirect('hr/attendance');
		}

		$val = Model_Hr_Attendance::validate('edit');

		if ($val->run())
		{
			$hr_attendance->employee_id = Input::post('employee_id');
			$hr_attendance->work_day = Input::post('work_day');
			$hr_attendance->status = Input::post('status');
			$hr_attendance->fdesk_user = Input::post('fdesk_user');

			if ($hr_attendance->save())
			{
				Session::set_flash('success', 'Updated hr_attendance #' . $id);

				Response::redirect('hr/attendance');
			}

			else
			{
				Session::set_flash('error', 'Could not update hr_attendance #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$hr_attendance->employee_id = $val->validated('employee_id');
				$hr_attendance->work_day = $val->validated('work_day');
				$hr_attendance->status = $val->validated('status');
				$hr_attendance->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('hr_attendance', $hr_attendance, false);
		}

		$this->template->title = "Hr_attendances";
		$this->template->content = View::forge('hr/attendance/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('hr/attendance');

        if (Input::method() == 'POST')
		{
			if ($hr_attendance = Model_Hr_Attendance::find($id))
			{
				$hr_attendance->delete();

				Session::set_flash('success', 'Deleted hr_attendance #'.$id);
			}

			else
			{
				Session::set_flash('error', 'Could not delete hr_attendance #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}
	
		Response::redirect('hr/attendance');

	}

}
