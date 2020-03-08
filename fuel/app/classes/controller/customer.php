<?php
class Controller_Customer extends Controller_Authenticate
{

	public function action_index()
	{
		$data['customers'] = Model_Customer::find('all');
		$this->template->title = "Customers";
		$this->template->content = View::forge('customer/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('registers/customer');

		if ( ! $data['customer'] = Model_Customer::find($id))
		{
			Session::set_flash('error', 'Could not find customer #'.$id);
			Response::redirect('registers/customer');
		}

		$this->template->title = "Customer";
		$this->template->content = View::forge('customer/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Customer::validate('create');

			if ($val->run())
			{
				$customer = Model_Customer::forge(array(
                    'customer_name' => Input::post('customer_name'),
                    'customer_type' => Input::post('customer_type'),
                    'customer_group' => Input::post('customer_group'),
                    'fdesk_user' => Input::post('fdesk_user'),
                    'inactive' => Input::post('inactive'),
                    'account_manager' => Input::post('account_manager'),
                    'bank_account' => Input::post('bank_account'),
                    'billing_currency' => Input::post('billing_currency'),
                    'default_rate_ref' => Input::post('default_rate_ref'),
                    'tax_ID' => Input::post('tax_ID'),
                    'occupation' => Input::post('occupation'),
                    'email_address' => Input::post('email_address'),
                    'mobile_phone' => Input::post('mobile_phone'),
                    'sex' => Input::post('sex'),
                    'title_of_courtesy' => Input::post('title_of_courtesy'),
                    'birth_date' => Input::post('birth_date'),
                    'first_billed' => Input::post('first_billed'),
                    'last_billed' => Input::post('last_billed'),
                    'credit_limit' => Input::post('credit_limit'),
                    'is_internal_customer' => Input::post('is_internal_customer'),
                    'on_hold' => Input::post('on_hold'),
                    'on_hold_from' => Input::post('on_hold_from'),
                    'on_hold_to' => Input::post('on_hold_to'),
                    'ID_type' => Input::post('ID_type'),
                    'ID_no' => Input::post('ID_no'),
                    'ID_country' => Input::post('ID_country'),
                    'remarks' => Input::post('remarks'),
                    // 'total_amount_billed' => Input::post('total_amount_billed'),
                    // 'total_amount_paid' => Input::post('total_amount_paid'),
                    // 'total_amount_not_billed' => Input::post('total_amount_not_billed'),
                ));
                
                // upload and save the file
				$file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $customer->ID_attachment = 'uploads'.DS.$file['name'];

				if ($customer and $customer->save())
				{
					Session::set_flash('success', 'Added customer #'.$customer->customer_name.'.');

					Response::redirect('registers/customer');
				}

				else
				{
					Session::set_flash('error', 'Could not save customer.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Customers";
		$this->template->content = View::forge('customer/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('registers/customer');

		if ( ! $customer = Model_Customer::find($id))
		{
			Session::set_flash('error', 'Could not find customer #'.$id);
			Response::redirect('registers/customer');
		}

		$val = Model_Customer::validate('edit');

		if ($val->run())
		{
            $customer->customer_name = Input::post('customer_name');
            $customer->customer_type = Input::post('customer_type');
            $customer->customer_group = Input::post('customer_group');
            $customer->fdesk_user = Input::post('fdesk_user');
            $customer->inactive = Input::post('inactive');
            $customer->account_manager = Input::post('account_manager');
            $customer->bank_account = Input::post('bank_account');
            $customer->billing_currency = Input::post('billing_currency');
            $customer->default_rate_ref = Input::post('default_rate_ref');
            $customer->tax_ID = Input::post('tax_ID');
            $customer->occupation = Input::post('occupation');
            $customer->email_address = Input::post('email_address');
            $customer->mobile_phone = Input::post('mobile_phone');
            $customer->sex = Input::post('sex');
            $customer->title_of_courtesy = Input::post('title_of_courtesy');
            $customer->birth_date = Input::post('birth_date');
            $customer->first_billed = Input::post('first_billed');
            $customer->last_billed = Input::post('last_billed');
            $customer->credit_limit = Input::post('credit_limit');
            $customer->is_internal_customer = Input::post('is_internal_customer');
            $customer->on_hold = Input::post('on_hold');
            $customer->on_hold_from = Input::post('on_hold_from');
            $customer->on_hold_to = Input::post('on_hold_to');
            $customer->ID_type = Input::post('ID_type');
            $customer->ID_no = Input::post('ID_no');
            $customer->ID_country = Input::post('ID_country');
            $customer->remarks = Input::post('remarks');
            // $customer->total_amount_billed = Input::post('total_amount_billed');
            // $customer->total_amount_paid = Input::post('total_amount_paid');
            // $customer->total_amount_not_billed = Input::post('total_amount_not_billed');

            // upload and save the file
            $file = Filehelper::upload();

            if (!empty($file['saved_as']))
                $customer->ID_attachment = 'uploads'.DS.$file['name'];

			if ($customer->save())
			{
				Session::set_flash('success', 'Updated customer #' . $customer->customer_name);

				Response::redirect('registers/customer');
			}

			else
			{
				Session::set_flash('error', 'Could not update customer #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
                // upload and save the file
                $file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $customer->ID_attachment = 'uploads'.DS.$file['name'];
                else 
                    $customer->ID_attachment = $val->validated('ID_attachment');

                $customer->customer_name = $val->validated('customer_name');
                $customer->customer_type = $val->validated('customer_type');
                $customer->customer_group = $val->validated('customer_group');
                $customer->fdesk_user = $val->validated('fdesk_user');
                $customer->inactive = $val->validated('inactive');
                $customer->account_manager = $val->validated('account_manager');
                $customer->bank_account = $val->validated('bank_account');
                $customer->billing_currency = $val->validated('billing_currency');
                $customer->default_rate_ref = $val->validated('default_rate_ref');
                $customer->tax_ID = $val->validated('tax_ID');
                $customer->occupation = $val->validated('occupation');
                $customer->email_address = $val->validated('email_address');
                $customer->mobile_phone = $val->validated('mobile_phone');
                $customer->sex = $val->validated('sex');
                $customer->title_of_courtesy = $val->validated('title_of_courtesy');
                $customer->birth_date = $val->validated('birth_date');
                $customer->first_billed = $val->validated('first_billed');
                $customer->last_billed = $val->validated('last_billed');
                $customer->credit_limit = $val->validated('credit_limit');
                $customer->is_internal_customer = $val->validated('is_internal_customer');
                $customer->on_hold = $val->validated('on_hold');
                $customer->on_hold_from = $val->validated('on_hold_from');
                $customer->on_hold_to = $val->validated('on_hold_to');
                $customer->ID_type = $val->validated('ID_type');
                $customer->ID_no = $val->validated('ID_no');
                $customer->ID_country = $val->validated('ID_country');
                $customer->remarks = $val->validated('remarks');
                // $customer->total_amount_billed = $val->validated('total_amount_billed');
                // $customer->total_amount_paid = $val->validated('total_amount_paid');
                // $customer->total_amount_not_billed = $val->validated('total_amount_not_billed');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('customer', $customer, false);
		}

		$this->template->title = "Customers";
		$this->template->content = View::forge('customer/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('registers/customer');

		if ($customer = Model_Customer::find($id))
		{
			$customer->delete();

			Session::set_flash('success', 'Deleted customer #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete customer #'.$id);
		}

		Response::redirect('registers/customer');

	}

    public function action_remove_img($id)
	{
		$customer = Model_Customer::find($id);
		if (!$customer) {
			Session::set_flash('error', 'Customer not found.');
			Response::redirect('registers/customer');
		}
        // unlink file
        try 
        {
            File::delete(DOCROOT . $customer->ID_attachment);
        }
        catch (Exception $e)
        {
            Session::set_flash('error', $e->getMessage());
    		Response::redirect('customer/edit/' . $customer->id);
        }

		// remove image path
		$customer->ID_attachment = '';
		if ($customer->save()) {
			Session::set_flash('success', 'Saved customer info.');
		}
		Response::redirect('customer/edit/' . $customer->id);
    }
    
}
