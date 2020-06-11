<?php

class Controller_Tenant extends Controller_Customer
{
	public function action_index()
	{
		$data['tenants'] = Model_Tenant::find('all', array('where' => array('customer_type' => Model_Tenant::CUSTOMER_TYPE_TENANT)));
		$this->template->title = "Tenant";
		$this->template->content = View::forge('tenant/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('registers/tenant');

		if ( ! $data['tenant'] = Model_Tenant::find($id))
		{
			Session::set_flash('error', 'Could not find tenant #'.$id);
			Response::redirect('registers/tenant');
		}

		$this->template->title = "Tenant";
		$this->template->content = View::forge('tenant/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Tenant::validate('create');

			if ($val->run())
			{
				$tenant = Model_Tenant::forge(array(
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
                    'is_internal_tenant' => Input::post('is_internal_tenant'),
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

                try {
                    if (!empty($file['saved_as']))
                        $tenant->ID_attachment = 'uploads'.DS.$file['name'];

                    if ($tenant and $tenant->save())
                    {
                        Session::set_flash('success', 'Added tenant #'.$tenant->customer_name.'.');

                        Response::redirect('registers/tenant');
                    }
                    else
                    {
                        Session::set_flash('error', 'Could not save tenant.');
                    }
                }
                catch (Fuel\Core\Database_Exception $e)
                {
                    Session::set_flash('error', $e->getMessage());
                    // throw $e;
                }                
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Customers";
		$this->template->content = View::forge('tenant/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('registers/tenant');

		if ( ! $tenant = Model_Tenant::find($id))
		{
			Session::set_flash('error', 'Could not find tenant #'.$id);
			Response::redirect('registers/tenant');
		}

		$val = Model_Tenant::validate('edit');

		if ($val->run())
		{
            $tenant->customer_name = Input::post('customer_name');
            $tenant->customer_type = Input::post('customer_type');
            $tenant->customer_group = Input::post('customer_group');
            $tenant->fdesk_user = Input::post('fdesk_user');
            $tenant->inactive = Input::post('inactive');
            $tenant->account_manager = Input::post('account_manager');
            $tenant->bank_account = Input::post('bank_account');
            $tenant->billing_currency = Input::post('billing_currency');
            $tenant->default_rate_ref = Input::post('default_rate_ref');
            $tenant->tax_ID = Input::post('tax_ID');
            $tenant->occupation = Input::post('occupation');
            $tenant->email_address = Input::post('email_address');
            $tenant->mobile_phone = Input::post('mobile_phone');
            $tenant->sex = Input::post('sex');
            $tenant->title_of_courtesy = Input::post('title_of_courtesy');
            $tenant->birth_date = Input::post('birth_date');
            $tenant->first_billed = Input::post('first_billed');
            $tenant->last_billed = Input::post('last_billed');
            $tenant->credit_limit = Input::post('credit_limit');
            $tenant->is_internal_tenant = Input::post('is_internal_tenant');
            $tenant->on_hold = Input::post('on_hold');
            $tenant->on_hold_from = Input::post('on_hold_from');
            $tenant->on_hold_to = Input::post('on_hold_to');
            $tenant->ID_type = Input::post('ID_type');
            $tenant->ID_no = Input::post('ID_no');
            $tenant->ID_country = Input::post('ID_country');
            $tenant->remarks = Input::post('remarks');
            // $tenant->total_amount_billed = Input::post('total_amount_billed');
            // $tenant->total_amount_paid = Input::post('total_amount_paid');
            // $tenant->total_amount_not_billed = Input::post('total_amount_not_billed');

            // upload and save the file
            $file = Filehelper::upload();

            if (!empty($file['saved_as']))
                $tenant->ID_attachment = 'uploads'.DS.$file['name'];

            try
            {
                if ($tenant->save())
                {
                    Session::set_flash('success', 'Updated tenant #' . $tenant->customer_name);

                    Response::redirect('registers/tenant');
                }
                else
                {
                    Session::set_flash('error', 'Could not update tenant #' . $id);
                }
            }
            catch (Fuel\Core\Database_Exception $e)
            {
                Session::set_flash('error', $e->getMessage());
                // throw $e;
            }
		}
		else
		{
			if (Input::method() == 'POST')
			{
                // upload and save the file
                $file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $tenant->ID_attachment = 'uploads'.DS.$file['name'];
                else 
                    $tenant->ID_attachment = $val->validated('ID_attachment');

                $tenant->customer_name = $val->validated('customer_name');
                $tenant->customer_type = $val->validated('customer_type');
                $tenant->customer_group = $val->validated('customer_group');
                $tenant->fdesk_user = $val->validated('fdesk_user');
                $tenant->inactive = $val->validated('inactive');
                $tenant->account_manager = $val->validated('account_manager');
                $tenant->bank_account = $val->validated('bank_account');
                $tenant->billing_currency = $val->validated('billing_currency');
                $tenant->default_rate_ref = $val->validated('default_rate_ref');
                $tenant->tax_ID = $val->validated('tax_ID');
                $tenant->occupation = $val->validated('occupation');
                $tenant->email_address = $val->validated('email_address');
                $tenant->mobile_phone = $val->validated('mobile_phone');
                $tenant->sex = $val->validated('sex');
                $tenant->title_of_courtesy = $val->validated('title_of_courtesy');
                $tenant->birth_date = $val->validated('birth_date');
                $tenant->first_billed = $val->validated('first_billed');
                $tenant->last_billed = $val->validated('last_billed');
                $tenant->credit_limit = $val->validated('credit_limit');
                $tenant->is_internal_tenant = $val->validated('is_internal_tenant');
                $tenant->on_hold = $val->validated('on_hold');
                $tenant->on_hold_from = $val->validated('on_hold_from');
                $tenant->on_hold_to = $val->validated('on_hold_to');
                $tenant->ID_type = $val->validated('ID_type');
                $tenant->ID_no = $val->validated('ID_no');
                $tenant->ID_country = $val->validated('ID_country');
                $tenant->remarks = $val->validated('remarks');
                // $tenant->total_amount_billed = $val->validated('total_amount_billed');
                // $tenant->total_amount_paid = $val->validated('total_amount_paid');
                // $tenant->total_amount_not_billed = $val->validated('total_amount_not_billed');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('tenant', $tenant, false);
		}

		$this->template->title = "Customers";
		$this->template->content = View::forge('tenant/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('registers/tenant');

        if (Input::method() == 'POST')
		{
            if ($tenant = Model_Tenant::find($id))
            {
                $tenant->delete();

                Session::set_flash('success', 'Deleted tenant #'.$id);
            }
            else
            {
                Session::set_flash('error', 'Could not delete tenant #'.$id);
            }
        }
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
        }
        
		Response::redirect('registers/tenant');

	}

    public function action_remove_img($id)
	{
		$tenant = Model_Tenant::find($id);
		if (!$tenant) {
			Session::set_flash('error', 'Tenant not found.');
			Response::redirect('registers/tenant');
		}
        // unlink file
        try 
        {
            File::delete(DOCROOT . $tenant->ID_attachment);
        }
        catch (Exception $e)
        {
            Session::set_flash('error', $e->getMessage());
    		Response::redirect('tenant/edit/' . $tenant->id);
        }

		// remove image path
		$tenant->ID_attachment = '';
		if ($tenant->save()) {
			Session::set_flash('success', 'Saved tenant info.');
		}
		Response::redirect('tenant/edit/' . $tenant->id);
    }
    
}
