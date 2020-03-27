<?php

class Controller_Accounts_Bank_Deposit extends Controller_Authenticate
{
	public function action_index()
	{
		$data['bank_deposits'] = Model_Accounts_Bank_Deposit::find('all');
		$this->template->title = "Bank Deposits";
		$this->template->content = View::forge('accounts/bank/deposit/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/bank-deposits');

		if ( ! $data['bank_deposit'] = Model_Accounts_Bank_Deposit::find($id))
		{
			Session::set_flash('error', 'Could not find bank deposit #'.$id);
			Response::redirect('accounts/bank-deposits');
		}

		$this->template->title = "Bank Deposits";
		$this->template->content = View::forge('accounts/bank/deposit/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Bank_Deposit::validate('create');

			if ($val->run())
			{
				$bank_deposit = Model_Accounts_Bank_Deposit::forge(array(
					'reference' => Input::post('reference'),
					'date' => Input::post('date'),
					'payer' => Input::post('payer'),
					'gl_account_id' => Input::post('gl_account_id'),
					'amount' => Input::post('amount'),
					'tax_id' => Input::post('tax_id'),
					'bank_account_id' => Input::post('bank_account_id'),
					'description' => Input::post('description'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($bank_deposit and $bank_deposit->save())
				{
					Session::set_flash('success', 'Added bank deposit #'.$bank_deposit->reference.'.');

					Response::redirect('accounts/bank-deposits');
				}
				else
				{
					Session::set_flash('error', 'Could not save bank deposit.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Bank Deposits";
		$this->template->content = View::forge('accounts/bank/deposit/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/bank-deposits');

		if ( ! $bank_deposit = Model_Accounts_Bank_Deposit::find($id))
		{
			Session::set_flash('error', 'Could not find bank deposit #'.$id);
			Response::redirect('accounts/bank-deposits');
		}

		$val = Model_Accounts_Bank_Deposit::validate('edit');

		if ($val->run())
		{
			$bank_deposit->reference = Input::post('reference');
			$bank_deposit->date = Input::post('date');
			$bank_deposit->payer = Input::post('payer');
			$bank_deposit->gl_account_id = Input::post('gl_account_id');
			$bank_deposit->amount = Input::post('amount');
			$bank_deposit->tax_id = Input::post('tax_id');
			$bank_deposit->bank_account_id = Input::post('bank_account_id');
			$bank_deposit->description = Input::post('description');
			$bank_deposit->fdesk_user = Input::post('fdesk_user');

			if ($bank_deposit->save())
			{
				Session::set_flash('success', 'Updated bank deposit #' . $id);

				Response::redirect('accounts/bank-deposits');
			}
			else
			{
				Session::set_flash('error', 'Could not update bank deposit #' . $id);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$bank_deposit->reference = $val->validated('reference');
				$bank_deposit->date = $val->validated('date');
				$bank_deposit->payer = $val->validated('payer');
				$bank_deposit->gl_account_id = $val->validated('gl_account_id');
				$bank_deposit->amount = $val->validated('amount');
				$bank_deposit->tax_id = $val->validated('tax_id');
				$bank_deposit->bank_account_id = $val->validated('bank_account_id');
				$bank_deposit->description = $val->validated('description');
				$bank_deposit->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('bank_deposit', $bank_deposit, false);
		}

		$this->template->title = "Bank Deposits";
		$this->template->content = View::forge('accounts/bank/deposit/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/bank-deposits');

		if (Input::method() == 'POST')
		{		
			if ($bank_deposit = Model_Accounts_Bank_Deposit::find($id))
			{
				$bank_deposit->delete();

				Session::set_flash('success', 'Deleted bank deposit #'.$id);
			}
			else
			{
				Session::set_flash('error', 'Could not delete bank deposit #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}
		
		Response::redirect('accounts/bank-deposits');
	}
}
