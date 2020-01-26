<?php

class Controller_Cash_Receipt extends Controller_Authenticate
{
	public function action_index()
	{
		// filter by open invoice receipts
		$data['cash_receipts'] = Model_Cash_Receipt::find('all', array('order_by' => array('reference' => 'desc'), 'limit' => 1000));
		$this->template->title = "Cash Receipts";
		$this->template->content = View::forge('cash/receipt/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('cash/receipt');

		if ( ! $data['cash_receipt'] = Model_Cash_Receipt::find($id))
		{
			Session::set_flash('error', 'Could not find cash receipt #'.$id);
			Response::redirect('cash/receipt');
		}

		$this->template->title = "Cash Receipts";
		$this->template->content = View::forge('cash/receipt/view', $data);

	}

	public function action_create($bill_id = null)
	{
		if ($bill = Model_Sales_Invoice::find($bill_id))
			$this->template->set_global('bill', $bill, false);

		if (Input::method() == 'POST')
		{
			$val = Model_Cash_Receipt::validate('create');

			if ($val->run())
			{
				$cash_receipt = Model_Cash_Receipt::forge(array(
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
					if ($cash_receipt and $cash_receipt->save())
					{
						// update Invoice and Guest Card
						Model_Cash_Receipt::updateInvoiceSettlement($bill, $cash_receipt->amount);
						Session::set_flash('success', 'Added cash receipt #'.$cash_receipt->reference.'.');
						Response::redirect('cash/receipt/view/'.$cash_receipt->id);
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

		$this->template->title = "Cash Receipts";
		$this->template->content = View::forge('cash/receipt/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('cash/receipt');

		if ( ! $cash_receipt = Model_Cash_Receipt::find($id))
		{
			Session::set_flash('error', 'Could not find cash receipt #'.$id);
			Response::redirect('cash/receipt');
		}

		$val = Model_Cash_Receipt::validate('edit');

		if ($val->run())
		{
			$cash_receipt->reference = Input::post('reference');
			$cash_receipt->bill_id = Input::post('bill_id');
			$cash_receipt->date = Input::post('date');
			$cash_receipt->payer = Input::post('payer');
			$cash_receipt->gl_account_id = Input::post('gl_account_id');
			$cash_receipt->amount = Input::post('amount');
			$cash_receipt->tax_id = Input::post('tax_id');
			$cash_receipt->bank_account_id = Input::post('bank_account_id');
			$cash_receipt->description = Input::post('description');
			$cash_receipt->fdesk_user = Input::post('fdesk_user');

			if ($cash_receipt->save())
			{
				Session::set_flash('success', 'Updated cash receipt #' . $cash_receipt->reference);

				Response::redirect('cash/receipt');
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
				$cash_receipt->reference = $val->validated('reference');
				$cash_receipt->bill_id = $val->validated('bill_id');
				$cash_receipt->date = $val->validated('date');
				$cash_receipt->payer = $val->validated('payer');
				$cash_receipt->gl_account_id = $val->validated('gl_account_id');
				$cash_receipt->amount = $val->validated('amount');
				$cash_receipt->tax_id = $val->validated('tax_id');
				$cash_receipt->bank_account_id = $val->validated('bank_account_id');
				$cash_receipt->description = $val->validated('description');
				$cash_receipt->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('cash_receipt', $cash_receipt, false);
		}

		$this->template->title = "Cash Receipts";
		$this->template->content = View::forge('cash/receipt/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('cash/receipt');

		if ($cash_receipt = Model_Cash_Receipt::find($id))
		{
			// prepare transaction reversal amount
			$reverse_amount = -1 * $cash_receipt->amount;
			// unset the receipt amount
			$cash_receipt->amount = 0;
			if ($cash_receipt->save()) // save to preserve audit trail or soft_delete after save
			{
				// update Invoice and Guest Card
				Model_Cash_Receipt::updateInvoiceSettlement($cash_receipt->invoice, $reverse_amount);
			}
			//if (is_null(Model_Cash_Receipt::find($id)))
				// updateInvoiceSettlement
			Session::set_flash('success', 'Canceled cash receipt #'.$cash_receipt->reference);
		}
		else
		{
			Session::set_flash('error', 'Could not cancel cash receipt #'.$id);
		}

		Response::redirect('cash/receipt');

	}

	public function action_to_print($id)
	{
		$data['receipt'] = Model_Cash_Receipt::find($id);

		$view = View::forge('template_hc');
		$view->title = 'Cash Receipt';
		$view->content = View::forge('document/cash_receipt', $data);

		return new Response($view);
	}
}
