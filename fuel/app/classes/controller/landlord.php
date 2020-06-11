<?php

class Controller_Landlord extends Controller_Customer
{
	public function action_index()
	{
		$data['landlords'] = Model_Landlord::find('all', array('where' => array('customer_type' => Model_Landlord::CUSTOMER_TYPE_OWNER)));
		$this->template->title = "Landlord";
		$this->template->content = View::forge('landlord/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('registers/landlord');

		if ( ! $data['landlord'] = Model_Landlord::find($id))
		{
			Session::set_flash('error', 'Could not find landlord #'.$id);
			Response::redirect('registers/landlord');
		}

		$this->template->title = "Landlord";
		$this->template->content = View::forge('landlord/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Landlord::validate('create');

			if ($val->run())
			{
				$landlord = Model_Landlord::forge(array(
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
                    'is_internal_landlord' => Input::post('is_internal_landlord'),
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
                        $landlord->ID_attachment = 'uploads'.DS.$file['name'];

                    if ($landlord and $landlord->save())
                    {
                        Session::set_flash('success', 'Added landlord #'.$landlord->customer_name.'.');

                        Response::redirect('registers/landlord');
                    }
                    else
                    {
                        Session::set_flash('error', 'Could not save landlord.');
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
		$this->template->content = View::forge('landlord/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('registers/landlord');

		if ( ! $landlord = Model_Landlord::find($id))
		{
			Session::set_flash('error', 'Could not find landlord #'.$id);
			Response::redirect('registers/landlord');
		}

		$val = Model_Landlord::validate('edit');

		if ($val->run())
		{
            $landlord->customer_name = Input::post('customer_name');
            $landlord->customer_type = Input::post('customer_type');
            $landlord->customer_group = Input::post('customer_group');
            $landlord->fdesk_user = Input::post('fdesk_user');
            $landlord->inactive = Input::post('inactive');
            $landlord->account_manager = Input::post('account_manager');
            $landlord->bank_account = Input::post('bank_account');
            $landlord->billing_currency = Input::post('billing_currency');
            $landlord->default_rate_ref = Input::post('default_rate_ref');
            $landlord->tax_ID = Input::post('tax_ID');
            $landlord->occupation = Input::post('occupation');
            $landlord->email_address = Input::post('email_address');
            $landlord->mobile_phone = Input::post('mobile_phone');
            $landlord->sex = Input::post('sex');
            $landlord->title_of_courtesy = Input::post('title_of_courtesy');
            $landlord->birth_date = Input::post('birth_date');
            $landlord->first_billed = Input::post('first_billed');
            $landlord->last_billed = Input::post('last_billed');
            $landlord->credit_limit = Input::post('credit_limit');
            $landlord->is_internal_landlord = Input::post('is_internal_landlord');
            $landlord->on_hold = Input::post('on_hold');
            $landlord->on_hold_from = Input::post('on_hold_from');
            $landlord->on_hold_to = Input::post('on_hold_to');
            $landlord->ID_type = Input::post('ID_type');
            $landlord->ID_no = Input::post('ID_no');
            $landlord->ID_country = Input::post('ID_country');
            $landlord->remarks = Input::post('remarks');
            // $landlord->total_amount_billed = Input::post('total_amount_billed');
            // $landlord->total_amount_paid = Input::post('total_amount_paid');
            // $landlord->total_amount_not_billed = Input::post('total_amount_not_billed');

            // upload and save the file
            $file = Filehelper::upload();

            if (!empty($file['saved_as']))
                $landlord->ID_attachment = 'uploads'.DS.$file['name'];

            try
            {
                if ($landlord->save())
                {
                    Session::set_flash('success', 'Updated landlord #' . $landlord->customer_name);

                    Response::redirect('registers/landlord');
                }
                else
                {
                    Session::set_flash('error', 'Could not update landlord #' . $id);
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
                    $landlord->ID_attachment = 'uploads'.DS.$file['name'];
                else 
                    $landlord->ID_attachment = $val->validated('ID_attachment');

                $landlord->customer_name = $val->validated('customer_name');
                $landlord->customer_type = $val->validated('customer_type');
                $landlord->customer_group = $val->validated('customer_group');
                $landlord->fdesk_user = $val->validated('fdesk_user');
                $landlord->inactive = $val->validated('inactive');
                $landlord->account_manager = $val->validated('account_manager');
                $landlord->bank_account = $val->validated('bank_account');
                $landlord->billing_currency = $val->validated('billing_currency');
                $landlord->default_rate_ref = $val->validated('default_rate_ref');
                $landlord->tax_ID = $val->validated('tax_ID');
                $landlord->occupation = $val->validated('occupation');
                $landlord->email_address = $val->validated('email_address');
                $landlord->mobile_phone = $val->validated('mobile_phone');
                $landlord->sex = $val->validated('sex');
                $landlord->title_of_courtesy = $val->validated('title_of_courtesy');
                $landlord->birth_date = $val->validated('birth_date');
                $landlord->first_billed = $val->validated('first_billed');
                $landlord->last_billed = $val->validated('last_billed');
                $landlord->credit_limit = $val->validated('credit_limit');
                $landlord->is_internal_landlord = $val->validated('is_internal_landlord');
                $landlord->on_hold = $val->validated('on_hold');
                $landlord->on_hold_from = $val->validated('on_hold_from');
                $landlord->on_hold_to = $val->validated('on_hold_to');
                $landlord->ID_type = $val->validated('ID_type');
                $landlord->ID_no = $val->validated('ID_no');
                $landlord->ID_country = $val->validated('ID_country');
                $landlord->remarks = $val->validated('remarks');
                // $landlord->total_amount_billed = $val->validated('total_amount_billed');
                // $landlord->total_amount_paid = $val->validated('total_amount_paid');
                // $landlord->total_amount_not_billed = $val->validated('total_amount_not_billed');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('landlord', $landlord, false);
		}

		$this->template->title = "Customers";
		$this->template->content = View::forge('landlord/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('registers/landlord');

        if (Input::method() == 'POST')
		{
            if ($landlord = Model_Landlord::find($id))
            {
                $landlord->delete();

                Session::set_flash('success', 'Deleted landlord #'.$id);
            }
            else
            {
                Session::set_flash('error', 'Could not delete landlord #'.$id);
            }
        }
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
        }
        
		Response::redirect('registers/landlord');

	}

    public function action_remove_img($id)
	{
		$landlord = Model_Landlord::find($id);
		if (!$landlord) {
			Session::set_flash('error', 'Landlord not found.');
			Response::redirect('registers/landlord');
		}
        // unlink file
        try 
        {
            File::delete(DOCROOT . $landlord->ID_attachment);
        }
        catch (Exception $e)
        {
            Session::set_flash('error', $e->getMessage());
    		Response::redirect('landlord/edit/' . $landlord->id);
        }

		// remove image path
		$landlord->ID_attachment = '';
		if ($landlord->save()) {
			Session::set_flash('success', 'Saved landlord info.');
		}
		Response::redirect('landlord/edit/' . $landlord->id);
    }
    
}
