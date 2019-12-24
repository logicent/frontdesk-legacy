<?php
class Controller_Expense_Claim extends Controller_Authenticate{

	public function action_index()
	{
		$data['expense_claims'] = Model_Expense_Claim::find('all');
		$this->template->title = "Expense Claims";
		$this->template->content = View::forge('expense/claim/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('expense/claim');

		if ( ! $data['expense_claim'] = Model_Expense_Claim::find($id))
		{
			Session::set_flash('error', 'Could not find expense claim #'.$id);
			Response::redirect('expense/claim');
		}

		$this->template->title = "Expense Claim";
		$this->template->content = View::forge('expense/claim/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Expense_Claim::validate('create');

			if ($val->run())
			{
				$expense_claim = Model_Expense_Claim::forge(array(
					'credit_account_id' => Input::post('credit_account_id'),
					'reference' => Input::post('reference'),
					'date' => Input::post('date'),
					'payer' => Input::post('payer'),
					'payee' => Input::post('payee'),
					'gl_account_id' => Input::post('gl_account_id'),
					'amount' => Input::post('amount'),
					'tax_id' => Input::post('tax_id'),
					'description' => Input::post('description'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($expense_claim and $expense_claim->save())
				{
					Session::set_flash('success', 'Added expense claim #'.$expense_claim->id.'.');

					Response::redirect('expense/claim');
				}

				else
				{
					Session::set_flash('error', 'Could not save expense_claim.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Expense Claims";
		$this->template->content = View::forge('expense/claim/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('expense/claim');

		if ( ! $expense_claim = Model_Expense_Claim::find($id))
		{
			Session::set_flash('error', 'Could not find expense claim #'.$id);
			Response::redirect('expense/claim');
		}

		$val = Model_Expense_Claim::validate('edit');

		if ($val->run())
		{
			$expense_claim->credit_account_id = Input::post('credit_account_id');
			$expense_claim->reference = Input::post('reference');
			$expense_claim->date = Input::post('date');
			$expense_claim->payer = Input::post('payer');
			$expense_claim->payee = Input::post('payee');
			$expense_claim->gl_account_id = Input::post('gl_account_id');
			$expense_claim->amount = Input::post('amount');
			$expense_claim->tax_id = Input::post('tax_id');
			$expense_claim->description = Input::post('description');
			$expense_claim->fdesk_user = Input::post('fdesk_user');

			if ($expense_claim->save())
			{
				Session::set_flash('success', 'Updated expense claim #' . $id);

				Response::redirect('expense/claim');
			}

			else
			{
				Session::set_flash('error', 'Could not update expense claim #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$expense_claim->credit_account_id = $val->validated('credit_account_id');
				$expense_claim->reference = $val->validated('reference');
				$expense_claim->date = $val->validated('date');
				$expense_claim->payer = $val->validated('payer');
				$expense_claim->payee = $val->validated('payee');
				$expense_claim->gl_account_id = $val->validated('gl_account_id');
				$expense_claim->amount = $val->validated('amount');
				$expense_claim->tax_id = $val->validated('tax_id');
				$expense_claim->description = $val->validated('description');
				$expense_claim->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('expense_claim', $expense_claim, false);
		}

		$this->template->title = "Expense Claims";
		$this->template->content = View::forge('expense/claim/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('expense/claim');

		if ($expense_claim = Model_Expense_Claim::find($id))
		{
			$expense_claim->delete();

			Session::set_flash('success', 'Deleted expense claim #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete expense claim #'.$id);
		}

		Response::redirect('expense/claim');

	}


}
