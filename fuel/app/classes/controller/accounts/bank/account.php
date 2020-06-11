<?php

class Controller_Accounts_Bank_Account extends Controller_Authenticate
{
	public function action_index()
	{
		$data['bank_accounts'] = Model_Accounts_Bank_Account::find('all');
		$this->template->title = "Bank Accounts";
		$this->template->content = View::forge('accounts/bank/account/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/bank-account');

		if ( ! $data['bank_account'] = Model_Accounts_Bank_Account::find($id))
		{
			Session::set_flash('error', 'Could not find bank account #'.$id);
			Response::redirect('accounts/bank-account');
		}
		$this->template->title = "Bank Accounts";
		$this->template->content = View::forge('accounts/bank/account/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Bank_Account::validate('create');
			if ($val->run())
			{
				$bank_account = Model_Accounts_Bank_Account::forge(array(
					'name' => Input::post('name'),
					'account_number' => Input::post('account_number'),
					'financial_institution' => Input::post('financial_institution'),
					'starting_bal' => Input::post('starting_bal'),
					'starting_date' => Input::post('starting_date'),
					'i_banking_na' => Input::post('i_banking_na'),
					'last_statement_date' => Input::post('last_statement_date'),
				));

				try {
					if ($bank_account and $bank_account->save())
					{
						Session::set_flash('success', 'Added bank account #'.$bank_account->account_number.'.');
						Response::redirect('accounts/bank-account');
					}
					else
					{
						Session::set_flash('error', 'Could not save bank account.');
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
		$this->template->title = "Bank Accounts";
		$this->template->content = View::forge('accounts/bank/account/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/bank-account');

		if ( ! $bank_account = Model_Accounts_Bank_Account::find($id))
		{
			Session::set_flash('error', 'Could not find bank account #'.$id);
			Response::redirect('accounts/bank-account');
		}

		$val = Model_Accounts_Bank_Account::validate('edit');
		if ($val->run())
		{
			$bank_account->name = Input::post('name');
			$bank_account->account_number = Input::post('account_number');
			$bank_account->financial_institution = Input::post('financial_institution');
			$bank_account->starting_bal = Input::post('starting_bal');
			$bank_account->starting_date = Input::post('starting_date');
			$bank_account->i_banking_na = Input::post('i_banking_na');
			$bank_account->last_statement_date = Input::post('last_statement_date');

			try {
				if ($bank_account->save())
				{
					Session::set_flash('success', 'Updated bank account #' . $id);
					Response::redirect('accounts/bank-account');
				}
				else
				{
					Session::set_flash('error', 'Could not update bank account #' . $id);
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
				$bank_account->name = $val->validated('name');
				$bank_account->account_number = $val->validated('account_number');
				$bank_account->financial_institution = $val->validated('financial_institution');
				$bank_account->starting_bal = $val->validated('starting_bal', null);
				$bank_account->starting_date = $val->validated('starting_date');
				$bank_account->i_banking_na = $val->validated('i_banking_na');
				$bank_account->last_statement_date = $val->validated('last_statement_date');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('bank_account', $bank_account, false);
		}
		$this->template->title = "Bank Accounts";
		$this->template->content = View::forge('accounts/bank/account/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/bank-account');

		if (Input::method() == 'POST')
		{		
			if ($bank_account = Model_Accounts_Bank_Account::find($id))
			{
				$deposit = Model_Accounts_Bank_Receipt::find('first', array('where' => array('bank_account_id' => $id)));
				if ($deposit)
					Session::set_flash('error', 'Account is already in use by Deposit(s).');
				else
				{
					$bank_account->delete();
					Session::set_flash('success', 'Deleted bank account #'.$id);
				}
			}
			else
			{
				Session::set_flash('error', 'Could not delete bank account #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}
		Response::redirect('accounts/bank-account');
	}
}
