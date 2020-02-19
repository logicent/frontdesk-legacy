<?php
class Controller_Partner extends Controller_Authenticate
{

	public function action_index()
	{
		$data['partners'] = Model_Partner::find('all');
		$this->template->title = "Partners";
		$this->template->content = View::forge('partner/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('registers/partner');

		if ( ! $data['partner'] = Model_Partner::find($id))
		{
			Session::set_flash('error', 'Could not find partner #'.$id);
			Response::redirect('registers/partner');
		}

		$this->template->title = "Partner";
		$this->template->content = View::forge('partner/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Partner::validate('create');

			if ($val->run())
			{
				$partner = Model_Partner::forge(array(
                    'partner_name' => Input::post('partner_name'),
                    'partner_type' => Input::post('partner_type'),
                    'partner_group' => Input::post('partner_group'),
                    'fdesk_user' => Input::post('fdesk_user'),
                    'inactive' => Input::post('inactive'),
                    'account_manager' => Input::post('account_manager'),
                    'bank_account' => Input::post('bank_account'),
                    'billing_currency' => Input::post('billing_currency'),
                    'default_rate_ref' => Input::post('default_rate_ref'),
                    'tax_ID' => Input::post('tax_ID'),
                    'email_address' => Input::post('email_address'),
                    'phone' => Input::post('phone'),
                    'first_billed' => Input::post('first_billed'),
                    'last_billed' => Input::post('last_billed'),
                    'credit_limit' => Input::post('credit_limit'),
                    'on_hold' => Input::post('on_hold'),
                    'on_hold_from' => Input::post('on_hold_from'),
                    'on_hold_to' => Input::post('on_hold_to'),
                    'remarks' => Input::post('remarks'),
                    // 'total_amount_billed' => Input::post('total_amount_billed'),
                    // 'total_amount_paid' => Input::post('total_amount_paid'),
                    // 'total_amount_not_billed' => Input::post('total_amount_not_billed'),
				));

				if ($partner and $partner->save())
				{
					Session::set_flash('success', 'Added partner #'.$partner->partner_name.'.');

					Response::redirect('registers/partner');
				}

				else
				{
					Session::set_flash('error', 'Could not save partner.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Partners";
		$this->template->content = View::forge('partner/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('registers/partner');

		if ( ! $partner = Model_Partner::find($id))
		{
			Session::set_flash('error', 'Could not find partner #'.$id);
			Response::redirect('registers/partner');
		}

		$val = Model_Partner::validate('edit');

		if ($val->run())
		{
            $partner->partner_name = Input::post('partner_name');
            $partner->partner_type = Input::post('partner_type');
            $partner->partner_group = Input::post('partner_group');
            $partner->fdesk_user = Input::post('fdesk_user');
            $partner->inactive = Input::post('inactive');
            $partner->account_manager = Input::post('account_manager');
            $partner->bank_account = Input::post('bank_account');
            $partner->billing_currency = Input::post('billing_currency');
            $partner->default_rate_ref = Input::post('default_rate_ref');
            $partner->tax_ID = Input::post('tax_ID');
            $partner->email_address = Input::post('email_address');
            $partner->phone = Input::post('phone');
            $partner->first_billed = Input::post('first_billed');
            $partner->last_billed = Input::post('last_billed');
            $partner->credit_limit = Input::post('credit_limit');
            $partner->on_hold = Input::post('on_hold');
            $partner->on_hold_from = Input::post('on_hold_from');
            $partner->on_hold_to = Input::post('on_hold_to');
            $partner->remarks = Input::post('remarks');
            // $partner->total_amount_billed = Input::post('total_amount_billed');
            // $partner->total_amount_paid = Input::post('total_amount_paid');
            // $partner->total_amount_not_billed = Input::post('total_amount_not_billed');

			if ($partner->save())
			{
				Session::set_flash('success', 'Updated partner #' . $partner->partner_name);

				Response::redirect('registers/partner');
			}

			else
			{
				Session::set_flash('error', 'Could not update partner #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
                $partner->partner_name = $val->validated('partner_name');
                $partner->partner_type = $val->validated('partner_type');
                $partner->partner_group = $val->validated('partner_group');
                $partner->fdesk_user = $val->validated('fdesk_user');
                $partner->inactive = $val->validated('inactive');
                $partner->account_manager = $val->validated('account_manager');
                $partner->bank_account = $val->validated('bank_account');
                $partner->billing_currency = $val->validated('billing_currency');
                $partner->default_rate_ref = $val->validated('default_rate_ref');
                $partner->tax_ID = $val->validated('tax_ID');
                $partner->email_address = $val->validated('email_address');
                $partner->phone = $val->validated('phone');
                $partner->first_billed = $val->validated('first_billed');
                $partner->last_billed = $val->validated('last_billed');
                $partner->credit_limit = $val->validated('credit_limit');
                $partner->on_hold = $val->validated('on_hold');
                $partner->on_hold_from = $val->validated('on_hold_from');
                $partner->on_hold_to = $val->validated('on_hold_to');
                $partner->remarks = $val->validated('remarks');
                // $partner->total_amount_billed = $val->validated('total_amount_billed');
                // $partner->total_amount_paid = $val->validated('total_amount_paid');
                // $partner->total_amount_not_billed = $val->validated('total_amount_not_billed');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('partner', $partner, false);
		}

		$this->template->title = "Partners";
		$this->template->content = View::forge('partner/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('registers/partner');

		if ($partner = Model_Partner::find($id))
		{
			$partner->delete();

			Session::set_flash('success', 'Deleted partner #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete partner #'.$id);
		}

		Response::redirect('registers/partner');

	}

}
