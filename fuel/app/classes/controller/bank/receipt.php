<?php

class Controller_Bank_Receipt extends Controller_Authenticate
{
	public function action_index()
	{
		$data['bank_receipts'] = Model_Bank_Receipt::find('all');
		$this->template->title = "Bank Deposits";
		$this->template->content = View::forge('bank/receipt/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('bank/receipt');

		if ( ! $data['bank_receipt'] = Model_Bank_Receipt::find($id))
		{
			Session::set_flash('error', 'Could not find bank receipt #'.$id);
			Response::redirect('bank/receipt');
		}

		$this->template->title = "Bank Deposits";
		$this->template->content = View::forge('bank/receipt/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Bank_Receipt::validate('create');

			if ($val->run())
			{
				$bank_receipt = Model_Bank_Receipt::forge(array(
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

				if ($bank_receipt and $bank_receipt->save())
				{
					Session::set_flash('success', 'Added bank receipt #'.$bank_receipt->reference.'.');

					Response::redirect('bank/receipt');
				}
				else
				{
					Session::set_flash('error', 'Could not save bank receipt.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Bank Deposits";
		$this->template->content = View::forge('bank/receipt/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('bank/receipt');

		if ( ! $bank_receipt = Model_Bank_Receipt::find($id))
		{
			Session::set_flash('error', 'Could not find bank receipt #'.$id);
			Response::redirect('bank/receipt');
		}

		$val = Model_Bank_Receipt::validate('edit');

		if ($val->run())
		{
			$bank_receipt->reference = Input::post('reference');
			$bank_receipt->date = Input::post('date');
			$bank_receipt->payer = Input::post('payer');
			$bank_receipt->gl_account_id = Input::post('gl_account_id');
			$bank_receipt->amount = Input::post('amount');
			$bank_receipt->tax_id = Input::post('tax_id');
			$bank_receipt->bank_account_id = Input::post('bank_account_id');
			$bank_receipt->description = Input::post('description');
			$bank_receipt->fdesk_user = Input::post('fdesk_user');

			if ($bank_receipt->save())
			{
				Session::set_flash('success', 'Updated bank receipt #' . $id);

				Response::redirect('bank/receipt');
			}
			else
			{
				Session::set_flash('error', 'Could not update bank receipt #' . $id);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$bank_receipt->reference = $val->validated('reference');
				$bank_receipt->date = $val->validated('date');
				$bank_receipt->payer = $val->validated('payer');
				$bank_receipt->gl_account_id = $val->validated('gl_account_id');
				$bank_receipt->amount = $val->validated('amount');
				$bank_receipt->tax_id = $val->validated('tax_id');
				$bank_receipt->bank_account_id = $val->validated('bank_account_id');
				$bank_receipt->description = $val->validated('description');
				$bank_receipt->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('bank_receipt', $bank_receipt, false);
		}

		$this->template->title = "Bank Deposits";
		$this->template->content = View::forge('bank/receipt/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('bank/receipt');

		if ($bank_receipt = Model_Bank_Receipt::find($id))
		{
			$bank_receipt->delete();

			Session::set_flash('success', 'Deleted bank receipt #'.$id);
		}
		else
		{
			Session::set_flash('error', 'Could not delete bank receipt #'.$id);
		}

		Response::redirect('bank/receipt');
	}
}
