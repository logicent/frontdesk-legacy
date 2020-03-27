<?php
class Controller_Hr_Employee extends Controller_Authenticate
{

	public function action_index()
	{
		$data['employees'] = Model_Employee::find('all');
		$this->template->title = "Employees";
		$this->template->content = View::forge('employee/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('registers/employee');

		if ( ! $data['employee'] = Model_Employee::find($id))
		{
			Session::set_flash('error', 'Could not find employee #'.$id);
			Response::redirect('registers/employee');
		}

		$this->template->title = "Employee";
		$this->template->content = View::forge('employee/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Employee::validate('create');

			if ($val->run())
			{
				$employee = Model_Employee::forge(array(
                    'employee_name' => Input::post('employee_name'),
                    'employee_type' => Input::post('employee_type'),
                    'employee_group' => Input::post('employee_group'),
                    'fdesk_user' => Input::post('fdesk_user'),
                    'inactive' => Input::post('inactive'),
                    'manager_id' => Input::post('manager_id'),
                    'bank_account' => Input::post('bank_account'),
                    'base_salary' => Input::post('base_salary'),
                    'tax_ID' => Input::post('tax_ID'),
                    'occupation' => Input::post('occupation'),
                    'email_address' => Input::post('email_address'),
                    'mobile_phone' => Input::post('mobile_phone'),
                    'sex' => Input::post('sex'),
                    'title_of_courtesy' => Input::post('title_of_courtesy'),
                    'birth_date' => Input::post('birth_date'),
                    'date_joined' => Input::post('date_joined'),
                    'date_left' => Input::post('date_left'),
                    // 'is_seconded_employee' => Input::post('is_seconded_employee'),
                    'on_hold' => Input::post('on_hold'),
                    'on_hold_from' => Input::post('on_hold_from'),
                    'on_hold_to' => Input::post('on_hold_to'),
                    'ID_type' => Input::post('ID_type'),
                    'ID_no' => Input::post('ID_no'),
                    'ID_country' => Input::post('ID_country'),
                    'remarks' => Input::post('remarks'),
                ));
                
                // upload and save the file
				$file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $employee->ID_attachment = 'uploads'.DS.$file['name'];

				if ($employee and $employee->save())
				{
					Session::set_flash('success', 'Added employee #'.$employee->employee_name.'.');

					Response::redirect('registers/employee');
				}

				else
				{
					Session::set_flash('error', 'Could not save employee.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Employees";
		$this->template->content = View::forge('employee/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('registers/employee');

		if ( ! $employee = Model_Employee::find($id))
		{
			Session::set_flash('error', 'Could not find employee #'.$id);
			Response::redirect('registers/employee');
		}

		$val = Model_Employee::validate('edit');

		if ($val->run())
		{
            $employee->employee_name = Input::post('employee_name');
            $employee->employee_type = Input::post('employee_type');
            $employee->employee_group = Input::post('employee_group');
            $employee->fdesk_user = Input::post('fdesk_user');
            $employee->inactive = Input::post('inactive');
            $employee->manager_id = Input::post('manager_id');
            $employee->bank_account = Input::post('bank_account');
            $employee->base_salary = Input::post('base_salary');
            $employee->tax_ID = Input::post('tax_ID');
            $employee->occupation = Input::post('occupation');
            $employee->email_address = Input::post('email_address');
            $employee->mobile_phone = Input::post('mobile_phone');
            $employee->sex = Input::post('sex');
            $employee->title_of_courtesy = Input::post('title_of_courtesy');
            $employee->birth_date = Input::post('birth_date');
            $employee->date_joined = Input::post('date_joined');
            $employee->date_left = Input::post('date_left');
            // $employee->is_seconded_employee = Input::post('is_seconded_employee');
            $employee->on_hold = Input::post('on_hold');
            $employee->on_hold_from = Input::post('on_hold_from');
            $employee->on_hold_to = Input::post('on_hold_to');
            $employee->ID_type = Input::post('ID_type');
            $employee->ID_no = Input::post('ID_no');
            $employee->ID_country = Input::post('ID_country');
            $employee->remarks = Input::post('remarks');

            // upload and save the file
            $file = Filehelper::upload();

            if (!empty($file['saved_as']))
                $employee->ID_attachment = 'uploads'.DS.$file['name'];

			if ($employee->save())
			{
				Session::set_flash('success', 'Updated employee #' . $employee->employee_name);

				Response::redirect('registers/employee');
			}

			else
			{
				Session::set_flash('error', 'Could not update employee #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
                // upload and save the file
                $file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $employee->ID_attachment = 'uploads'.DS.$file['name'];
                else 
                    $employee->ID_attachment = $val->validated('ID_attachment');

                $employee->employee_name = $val->validated('employee_name');
                $employee->employee_type = $val->validated('employee_type');
                $employee->employee_group = $val->validated('employee_group');
                $employee->fdesk_user = $val->validated('fdesk_user');
                $employee->inactive = $val->validated('inactive');
                $employee->manager_id = $val->validated('manager_id');
                $employee->bank_account = $val->validated('bank_account');
                $employee->base_salary = $val->validated('base_salary');
                $employee->tax_ID = $val->validated('tax_ID');
                $employee->occupation = $val->validated('occupation');
                $employee->email_address = $val->validated('email_address');
                $employee->mobile_phone = $val->validated('mobile_phone');
                $employee->sex = $val->validated('sex');
                $employee->title_of_courtesy = $val->validated('title_of_courtesy');
                $employee->birth_date = $val->validated('birth_date');
                $employee->date_joined = $val->validated('date_joined');
                $employee->date_left = $val->validated('date_left');
                // $employee->is_seconded_employee = $val->validated('is_seconded_employee');
                $employee->on_hold = $val->validated('on_hold');
                $employee->on_hold_from = $val->validated('on_hold_from');
                $employee->on_hold_to = $val->validated('on_hold_to');
                $employee->ID_type = $val->validated('ID_type');
                $employee->ID_no = $val->validated('ID_no');
                $employee->ID_country = $val->validated('ID_country');
                $employee->remarks = $val->validated('remarks');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('employee', $employee, false);
		}

		$this->template->title = "Employees";
		$this->template->content = View::forge('employee/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('registers/employee');

        if (Input::method() == 'POST')
		{
			if ($employee = Model_Employee::find($id))
			{
				$employee->delete();

				Session::set_flash('success', 'Deleted employee #'.$id);
			}
			else
			{
				Session::set_flash('error', 'Could not delete employee #'.$id);
			}
        }
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}
		
		Response::redirect('registers/employee');

	}

    public function action_remove_img($id)
	{
		$employee = Model_Employee::find($id);
		if (!$employee) {
			Session::set_flash('error', 'Employee not found.');
			Response::redirect('registers/employee');
		}
        // unlink file
        try 
        {
            File::delete(DOCROOT . $employee->ID_attachment);
        }
        catch (Exception $e)
        {
            Session::set_flash('error', $e->getMessage());
    		Response::redirect('employee/edit/' . $employee->id);
        }

		// remove image path
		$employee->ID_attachment = '';
		if ($employee->save()) {
			Session::set_flash('success', 'Saved employee info.');
		}
		Response::redirect('employee/edit/' . $employee->id);
	}
}
