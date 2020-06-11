<?php

class Controller_Member extends Controller_Customer
{
	public function action_index()
	{
		$data['members'] = Model_Member::find('all', array('where' => array('customer_type' => Model_Member::CUSTOMER_TYPE_TENANT)));
		$this->template->title = "Member";
		$this->template->content = View::forge('member/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('registers/member');

		if ( ! $data['member'] = Model_Member::find($id))
		{
			Session::set_flash('error', 'Could not find member #'.$id);
			Response::redirect('registers/member');
		}

		$this->template->title = "Member";
		$this->template->content = View::forge('member/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Member::validate('create');

			if ($val->run())
			{
				$member = Model_Member::forge(array(
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
                    'is_internal_member' => Input::post('is_internal_member'),
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
                        $member->ID_attachment = 'uploads'.DS.$file['name'];

                    if ($member and $member->save())
                    {
                        Session::set_flash('success', 'Added member #'.$member->customer_name.'.');

                        Response::redirect('registers/member');
                    }
                    else
                    {
                        Session::set_flash('error', 'Could not save member.');
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
		$this->template->content = View::forge('member/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('registers/member');

		if ( ! $member = Model_Member::find($id))
		{
			Session::set_flash('error', 'Could not find member #'.$id);
			Response::redirect('registers/member');
		}

		$val = Model_Member::validate('edit');

		if ($val->run())
		{
            $member->customer_name = Input::post('customer_name');
            $member->customer_type = Input::post('customer_type');
            $member->customer_group = Input::post('customer_group');
            $member->fdesk_user = Input::post('fdesk_user');
            $member->inactive = Input::post('inactive');
            $member->account_manager = Input::post('account_manager');
            $member->bank_account = Input::post('bank_account');
            $member->billing_currency = Input::post('billing_currency');
            $member->default_rate_ref = Input::post('default_rate_ref');
            $member->tax_ID = Input::post('tax_ID');
            $member->occupation = Input::post('occupation');
            $member->email_address = Input::post('email_address');
            $member->mobile_phone = Input::post('mobile_phone');
            $member->sex = Input::post('sex');
            $member->title_of_courtesy = Input::post('title_of_courtesy');
            $member->birth_date = Input::post('birth_date');
            $member->first_billed = Input::post('first_billed');
            $member->last_billed = Input::post('last_billed');
            $member->credit_limit = Input::post('credit_limit');
            $member->is_internal_member = Input::post('is_internal_member');
            $member->on_hold = Input::post('on_hold');
            $member->on_hold_from = Input::post('on_hold_from');
            $member->on_hold_to = Input::post('on_hold_to');
            $member->ID_type = Input::post('ID_type');
            $member->ID_no = Input::post('ID_no');
            $member->ID_country = Input::post('ID_country');
            $member->remarks = Input::post('remarks');
            // $member->total_amount_billed = Input::post('total_amount_billed');
            // $member->total_amount_paid = Input::post('total_amount_paid');
            // $member->total_amount_not_billed = Input::post('total_amount_not_billed');

            // upload and save the file
            $file = Filehelper::upload();

            if (!empty($file['saved_as']))
                $member->ID_attachment = 'uploads'.DS.$file['name'];

            try
            {
                if ($member->save())
                {
                    Session::set_flash('success', 'Updated member #' . $member->customer_name);

                    Response::redirect('registers/member');
                }
                else
                {
                    Session::set_flash('error', 'Could not update member #' . $id);
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
                    $member->ID_attachment = 'uploads'.DS.$file['name'];
                else 
                    $member->ID_attachment = $val->validated('ID_attachment');

                $member->customer_name = $val->validated('customer_name');
                $member->customer_type = $val->validated('customer_type');
                $member->customer_group = $val->validated('customer_group');
                $member->fdesk_user = $val->validated('fdesk_user');
                $member->inactive = $val->validated('inactive');
                $member->account_manager = $val->validated('account_manager');
                $member->bank_account = $val->validated('bank_account');
                $member->billing_currency = $val->validated('billing_currency');
                $member->default_rate_ref = $val->validated('default_rate_ref');
                $member->tax_ID = $val->validated('tax_ID');
                $member->occupation = $val->validated('occupation');
                $member->email_address = $val->validated('email_address');
                $member->mobile_phone = $val->validated('mobile_phone');
                $member->sex = $val->validated('sex');
                $member->title_of_courtesy = $val->validated('title_of_courtesy');
                $member->birth_date = $val->validated('birth_date');
                $member->first_billed = $val->validated('first_billed');
                $member->last_billed = $val->validated('last_billed');
                $member->credit_limit = $val->validated('credit_limit');
                $member->is_internal_member = $val->validated('is_internal_member');
                $member->on_hold = $val->validated('on_hold');
                $member->on_hold_from = $val->validated('on_hold_from');
                $member->on_hold_to = $val->validated('on_hold_to');
                $member->ID_type = $val->validated('ID_type');
                $member->ID_no = $val->validated('ID_no');
                $member->ID_country = $val->validated('ID_country');
                $member->remarks = $val->validated('remarks');
                // $member->total_amount_billed = $val->validated('total_amount_billed');
                // $member->total_amount_paid = $val->validated('total_amount_paid');
                // $member->total_amount_not_billed = $val->validated('total_amount_not_billed');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('member', $member, false);
		}

		$this->template->title = "Customers";
		$this->template->content = View::forge('member/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('registers/member');

        if (Input::method() == 'POST')
		{
            if ($member = Model_Member::find($id))
            {
                $member->delete();

                Session::set_flash('success', 'Deleted member #'.$id);
            }
            else
            {
                Session::set_flash('error', 'Could not delete member #'.$id);
            }
        }
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
        }
        
		Response::redirect('registers/member');

	}

    public function action_remove_img($id)
	{
		$member = Model_Member::find($id);
		if (!$member) {
			Session::set_flash('error', 'Member not found.');
			Response::redirect('registers/member');
		}
        // unlink file
        try 
        {
            File::delete(DOCROOT . $member->ID_attachment);
        }
        catch (Exception $e)
        {
            Session::set_flash('error', $e->getMessage());
    		Response::redirect('member/edit/' . $member->id);
        }

		// remove image path
		$member->ID_attachment = '';
		if ($member->save()) {
			Session::set_flash('success', 'Saved member info.');
		}
		Response::redirect('member/edit/' . $member->id);
    }
    
}
