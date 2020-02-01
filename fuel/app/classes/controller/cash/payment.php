<?php

class Controller_Cash_Payment extends Controller_Authenticate
{
	public function action_index()
	{
		$data['cash_payments'] = Model_Cash_Payment::find('all', array('order_by' => array('reference' => 'desc'), 'limit' => 1000));
		$this->template->title = "Cash Expenses";
		$this->template->content = View::forge('cash/payment/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('cash/payment');

		if ( ! $data['cash_payment'] = Model_Cash_Payment::find($id))
		{
			Session::set_flash('error', 'Could not find cash expense #'.$id);
			Response::redirect('cash/payment');
		}

		$this->template->title = "Cash Expenses";
		$this->template->content = View::forge('cash/payment/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Cash_Payment::validate('create');

			if ($val->run())
			{
				$cash_payment = Model_Cash_Payment::forge(array(
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
					if ($cash_payment and $cash_payment->save())
					{
						Session::set_flash('success', 'Added cash expense #'.$cash_payment->id.'.');
						Response::redirect('cash/payment');
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

		$this->template->title = "Cash Expenses";
		$this->template->content = View::forge('cash/payment/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('cash/payment');

		if ( ! $cash_payment = Model_Cash_Payment::find($id))
		{
			Session::set_flash('error', 'Could not find cash expense #'.$id);
			Response::redirect('cash/payment');
		}

		$val = Model_Cash_Payment::validate('edit');

		if ($val->run())
		{
			$cash_payment->reference = Input::post('reference');
			$cash_payment->date = Input::post('date');
			$cash_payment->payee = Input::post('payee');
			$cash_payment->gl_account_id = Input::post('gl_account_id');
			$cash_payment->amount = Input::post('amount');
			$cash_payment->tax_id = Input::post('tax_id');
			$cash_payment->bank_account_id = Input::post('bank_account_id');
			$cash_payment->description = Input::post('description');
			$cash_payment->fdesk_user = Input::post('fdesk_user');

			if ($cash_payment->save())
			{
				Session::set_flash('success', 'Updated cash expense #' . $id);

				Response::redirect('cash/payment');
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
				$cash_payment->reference = $val->validated('reference');
				$cash_payment->date = $val->validated('date');
				$cash_payment->payee = $val->validated('payee');
				$cash_payment->gl_account_id = $val->validated('gl_account_id');
				$cash_payment->amount = $val->validated('amount');
				$cash_payment->tax_id = $val->validated('tax_id');
				$cash_payment->bank_account_id = $val->validated('bank_account_id');
				$cash_payment->description = $val->validated('description');
				$cash_payment->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('cash_payment', $cash_payment, false);
		}

		$this->template->title = "Cash Expenses";
		$this->template->content = View::forge('cash/payment/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('cash/payment');

		if ($cash_payment = Model_Cash_Payment::find($id))
		{
			$cash_payment->delete();

			Session::set_flash('success', 'Deleted cash expense #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete cash expense #'.$id);
		}

		Response::redirect('cash/payment');

	}

}
