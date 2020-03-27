<?php

class Controller_Accounts_Payment_Expense extends Controller_Authenticate
{
	public function action_index()
	{
		$data['expenses'] = Model_Accounts_Payment_Expense::find('all', array('order_by' => array('reference' => 'desc'), 'limit' => 1000));
		$this->template->title = "Expenses";
		$this->template->content = View::forge('accounts/payment/expense/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/expenses');

		if ( ! $data['expense'] = Model_Accounts_Payment_Expense::find($id))
		{
			Session::set_flash('error', 'Could not find cash expense #'.$id);
			Response::redirect('accounts/expenses');
		}

		$this->template->title = "Expenses";
		$this->template->content = View::forge('accounts/payment/expense/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Payment_Expense::validate('create');

			if ($val->run())
			{
				$expense = Model_Accounts_Payment_Expense::forge(array(
					'reference' => Input::post('reference'),
					'date' => Input::post('date'),
					'payee' => Input::post('payee'),
					'gl_account_id' => Input::post('gl_account_id'),
					'amount' => Input::post('amount'),
					'tax_id' => Input::post('tax_id'),
					'bank_account_id' => Input::post('bank_account_id'),
					'description' => Input::post('description'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				try {
					if ($expense and $expense->save())
					{
						Session::set_flash('success', 'Added cash expense #'.$expense->id.'.');
						Response::redirect('accounts/expenses');
					}
				}
				catch (Fuel\Core\Database_Exception $e) {
					Session::set_flash('error', $e->getMessage());
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Expenses";
		$this->template->content = View::forge('accounts/payment/expense/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/expenses');

		if ( ! $expense = Model_Accounts_Payment_Expense::find($id))
		{
			Session::set_flash('error', 'Could not find cash expense #'.$id);
			Response::redirect('accounts/expenses');
		}

		$val = Model_Accounts_Payment_Expense::validate('edit');

		if ($val->run())
		{
			$expense->reference = Input::post('reference');
			$expense->date = Input::post('date');
			$expense->payee = Input::post('payee');
			$expense->gl_account_id = Input::post('gl_account_id');
			$expense->amount = Input::post('amount');
			$expense->tax_id = Input::post('tax_id');
			$expense->bank_account_id = Input::post('bank_account_id');
			$expense->description = Input::post('description');
			$expense->fdesk_user = Input::post('fdesk_user');

			if ($expense->save())
			{
				Session::set_flash('success', 'Updated cash expense #' . $id);

				Response::redirect('accounts/expenses');
			}

			else
			{
				Session::set_flash('error', 'Could not update cash expense #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$expense->reference = $val->validated('reference');
				$expense->date = $val->validated('date');
				$expense->payee = $val->validated('payee');
				$expense->gl_account_id = $val->validated('gl_account_id');
				$expense->amount = $val->validated('amount');
				$expense->tax_id = $val->validated('tax_id');
				$expense->bank_account_id = $val->validated('bank_account_id');
				$expense->description = $val->validated('description');
				$expense->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('expense', $expense, false);
		}

		$this->template->title = "Expenses";
		$this->template->content = View::forge('accounts/payment/expense/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/expenses');

		if (Input::method() == 'POST')
		{			
			if ($expense = Model_Accounts_Payment_Expense::find($id))
			{
				$expense->delete();

				Session::set_flash('success', 'Deleted cash expense #'.$id);
			}

			else
			{
				Session::set_flash('error', 'Could not delete cash expense #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}

		Response::redirect('accounts/expenses');

	}

}
