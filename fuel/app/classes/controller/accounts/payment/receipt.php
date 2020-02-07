<?php

class Controller_Accounts_Payment_Receipt extends Controller_Authenticate
{
	public function action_index()
	{
		// filter by open invoice receipts
		$data['payment_receipts'] = Model_Accounts_Payment_Receipt::find('all', array('order_by' => array('reference' => 'desc'), 'limit' => 1000));
		$this->template->title = "Receipts";
		$this->template->content = View::forge('accounts/payment/receipt/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/sales-receipts');

		if ( ! $data['payment_receipt'] = Model_Accounts_Payment_Receipt::find($id))
		{
			Session::set_flash('error', 'Could not find cash receipt #'.$id);
			Response::redirect('accounts/sales-receipts');
		}

		$this->template->title = "Receipts";
		$this->template->content = View::forge('accounts/payment/receipt/view', $data);

	}

	public function action_create($bill_id = null)
	{
		if ($bill = Model_Sales_Invoice::find($bill_id))
			$this->template->set_global('bill', $bill, false);

		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Payment_Receipt::validate('create');

			if ($val->run())
			{
				$payment_receipt = Model_Accounts_Payment_Receipt::forge(array(
					'reference' => Input::post('reference'),
					'bill_id' => Input::post('bill_id'),
					'date' => Input::post('date'),
					'payer' => Input::post('payer'),
					'gl_account_id' => Input::post('gl_account_id'),
					'amount' => Input::post('amount'),
					'tax_id' => Input::post('tax_id'),
					'bank_account_id' => Input::post('bank_account_id'),
					'description' => Input::post('description'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				try {
					if ($payment_receipt and $payment_receipt->save())
					{
						// update Invoice and Guest Card
						Model_Accounts_Payment_Receipt::updateInvoiceSettlement($bill, $payment_receipt->amount);
						Session::set_flash('success', 'Added cash receipt #'.$payment_receipt->reference.'.');
						Response::redirect('accounts/payment/receipt/view/'.$payment_receipt->id);
					}
				}
				catch (Fuel\Core\Database_Exception $e)
				{
					Session::set_flash('error', $e->getMessage());
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Receipts";
		$this->template->content = View::forge('accounts/payment/receipt/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/sales-receipts');

		if ( ! $payment_receipt = Model_Accounts_Payment_Receipt::find($id))
		{
			Session::set_flash('error', 'Could not find cash receipt #'.$id);
			Response::redirect('accounts/sales-receipts');
		}

		$val = Model_Accounts_Payment_Receipt::validate('edit');

		if ($val->run())
		{
			$payment_receipt->reference = Input::post('reference');
			$payment_receipt->bill_id = Input::post('bill_id');
			$payment_receipt->date = Input::post('date');
			$payment_receipt->payer = Input::post('payer');
			$payment_receipt->gl_account_id = Input::post('gl_account_id');
			$payment_receipt->amount = Input::post('amount');
			$payment_receipt->tax_id = Input::post('tax_id');
			$payment_receipt->bank_account_id = Input::post('bank_account_id');
			$payment_receipt->description = Input::post('description');
			$payment_receipt->fdesk_user = Input::post('fdesk_user');

			if ($payment_receipt->save())
			{
				Session::set_flash('success', 'Updated cash receipt #' . $payment_receipt->reference);

				Response::redirect('accounts/sales-receipts');
			}

			else
			{
				Session::set_flash('error', 'Could not update cash receipt #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$payment_receipt->reference = $val->validated('reference');
				$payment_receipt->bill_id = $val->validated('bill_id');
				$payment_receipt->date = $val->validated('date');
				$payment_receipt->payer = $val->validated('payer');
				$payment_receipt->gl_account_id = $val->validated('gl_account_id');
				$payment_receipt->amount = $val->validated('amount');
				$payment_receipt->tax_id = $val->validated('tax_id');
				$payment_receipt->bank_account_id = $val->validated('bank_account_id');
				$payment_receipt->description = $val->validated('description');
				$payment_receipt->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('payment_receipt', $payment_receipt, false);
		}

		$this->template->title = "Receipts";
		$this->template->content = View::forge('accounts/payment/receipt/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/sales-receipts');

		if ($payment_receipt = Model_Accounts_Payment_Receipt::find($id))
		{
			// prepare transaction reversal amount
			$reverse_amount = -1 * $payment_receipt->amount;
			// unset the receipt amount
			$payment_receipt->amount = 0;
			if ($payment_receipt->save()) // save to preserve audit trail or soft_delete after save
			{
				// update Invoice and Guest Card
				Model_Accounts_Payment_Receipt::updateInvoiceSettlement($payment_receipt->invoice, $reverse_amount);
			}
			//if (is_null(Model_Accounts_Payment_Receipt::find($id)))
				// updateInvoiceSettlement
			Session::set_flash('success', 'Canceled cash receipt #'.$payment_receipt->reference);
		}
		else
		{
			Session::set_flash('error', 'Could not cancel cash receipt #'.$id);
		}

		Response::redirect('accounts/sales-receipts');

	}

	public function action_to_print($id)
	{
		$data['receipt'] = Model_Accounts_Payment_Receipt::find($id);

		$view = View::forge('template_hc');
		$view->title = 'Receipt';
		$view->content = View::forge('document/payment_receipt', $data);

		return new Response($view);
	}
}
