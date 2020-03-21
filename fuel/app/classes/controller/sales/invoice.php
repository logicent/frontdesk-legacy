<?php

class Controller_Sales_Invoice extends Controller_Authenticate
{
	public function action_index($show_del = false)
	{
		if ($show_del)
			$data['sales_invoices'] = Model_Sales_Invoice::deleted('all');
		else
		{
			$status = Input::get('status');
			if (!$status)
				$status = Model_Sales_Invoice::INVOICE_STATUS_OPEN;

            $data['sales_invoices'] = Model_Sales_Invoice::find('all', 
                                        array('where' => array(
                                            array('status', '=', $status)
                                        ), 
                                        'order_by' => array('invoice_num' => 'desc'), 
                                        'limit' => 1000));
		}

		$data['status'] = $status;
        
		$this->template->title = "Invoices";
		$this->template->content = View::forge('sales/invoice/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/sales-invoice');

		if ( ! $data['sales_invoice'] = Model_Sales_Invoice::find($id))
		{
			Session::set_flash('error', 'Could not find invoice #'.$id);
			Response::redirect('accounts/sales-invoice');
		}

		$this->template->title = "Invoice";
		$this->template->content = View::forge('sales/invoice/view', $data);

	}

	public function action_create($id = null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Sales_Invoice::validate('create');

			if ($val->run())
			{
				$sales_invoice = Model_Sales_Invoice::forge(array(
					'invoice_num' => Input::post('invoice_num'),
					'po_number' => Input::post('po_number'),
					'amounts_tax_inc' => Input::post('amounts_tax_inc'),
					'issue_date' => Input::post('issue_date'),
					'due_date' => Input::post('due_date'),
					'status' => Input::post('status'),
					'source' => Input::post('source'),
					'source_id' => Input::post('source_id'),
					'customer_name' => Input::post('customer_name'),
					'unit_name' => Input::post('unit_name'),
					'amount_due' => Input::post('amount_due'),
					'disc_total' => Input::post('disc_total'),
					'tax_total' => Input::post('tax_total'),
					'amount_paid' => Input::post('amount_paid'),
					'balance_due' => Input::post('balance_due'),
					'advance_paid' => Input::post('advance_paid'),
					'paid_status' => Input::post('paid_status'),
					'billing_address' => Input::post('billing_address'),
					'summary' => Input::post('summary'),
					'notes' => Input::post('notes'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($sales_invoice and $sales_invoice->save())
				{
					Session::set_flash('success', 'Added invoice #'.$sales_invoice->id.'.');

					Response::redirect('accounts/sales-invoice');
				}

				else
				{
					Session::set_flash('error', 'Could not save invoice.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

        // !!! check the source and load correct model ref
		// $booking = Model_Facility_Booking::find($id);
		// $lease = Model_Lease::find($id);
		// $this->template->set_global('order', $booking, false);

		// prepare invoice item as global variable
		$sales_invoice_item = Model_Sales_Invoice_Item::forge();
		$this->template->set_global('sales_invoice_item', $sales_invoice_item, false);

		// get billable and enabled item
        $services = DB::select('id','code')
                        ->from('service_item')
                        ->where(array('billable' => true, 'enabled' => true))
                        ->execute()
                        ->as_array();
        
		$this->template->set_global('serviceItems', json_encode($services), false);

		$this->template->title = "Invoices";
		$this->template->content = View::forge('sales/invoice/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/sales-invoice');

		if ( ! $sales_invoice = Model_Sales_Invoice::find($id))
		{
			Session::set_flash('error', 'Could not find invoice #'.$id);
			Response::redirect('accounts/sales-invoice');
		}

		$val = Model_Sales_Invoice::validate('edit');
		// Debug::dump(Input::post()); exit;
		if ($val->run())
		{
			$sales_invoice->invoice_num = Input::post('invoice_num');
			$sales_invoice->po_number = Input::post('po_number');
			$sales_invoice->amounts_tax_inc = Input::post('amounts_tax_inc');
			$sales_invoice->issue_date = Input::post('issue_date');
			$sales_invoice->due_date = Input::post('due_date');
			$sales_invoice->status = Input::post('status');
			$sales_invoice->source = Input::post('source');
			$sales_invoice->source_id = Input::post('source_id');
			$sales_invoice->customer_name = Input::post('customer_name');
			$sales_invoice->unit_name = Input::post('unit_name');
			$sales_invoice->amount_due = Input::post('amount_due');
			$sales_invoice->disc_total = Input::post('disc_total');
			$sales_invoice->tax_total = Input::post('tax_total');
			$sales_invoice->amount_paid = Input::post('amount_paid');
			$sales_invoice->balance_due = Input::post('balance_due');
			$sales_invoice->advance_paid = Input::post('advance_paid');
			$sales_invoice->paid_status = Input::post('paid_status');
			$sales_invoice->billing_address = Input::post('billing_address');
			$sales_invoice->summary = Input::post('summary');
			$sales_invoice->notes = Input::post('notes');
			$sales_invoice->fdesk_user = Input::post('fdesk_user');

			// update Invoice Amounts if discounted
			Model_Sales_Invoice::applyDiscountAmount($sales_invoice);
			
			if ($sales_invoice->save())
			{
				// save the line item(s)
				for ($i=1; $i = count(Input::post('item_id')); $i++)
				{
					$sales_invoice_item = Model_Sales_Invoice_Item::forge(array(
						'item_id' => Input::post("item_id")[$i],
						'qty' => Input::post("qty")[$i],
						'unit_price' => Input::post("unit_price")[$i],
						'amount' => Input::post("amount")[$i],
						'invoice_id' => $sales_invoice->id,
						'discount_percent' => Input::post("discount_percent")[$i],
						'gl_account_id' => null, // Input::post("gl_account_id")[$i],
						'description' => Input::post("description")[$i],
					));
	
					$sales_invoice_item->save();
				}

				Session::set_flash('success', 'Updated invoice #' . $id);

				Response::redirect('accounts/sales-invoice');
			}

			else
			{
				Session::set_flash('error', 'Could not update invoice #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$sales_invoice->invoice_num = $val->validated('invoice_num');
				$sales_invoice->po_number = $val->validated('po_number');
				$sales_invoice->amounts_tax_inc = $val->validated('amounts_tax_inc');
				$sales_invoice->issue_date = $val->validated('issue_date');
				$sales_invoice->due_date = $val->validated('due_date');
				$sales_invoice->status = $val->validated('status');
				$sales_invoice->source = $val->validated('source');
				$sales_invoice->source_id = $val->validated('source_id');
                $sales_invoice->customer_name = $val->validated('customer_name');
			    $sales_invoice->unit_name = $val->validated('unit_name');
				$sales_invoice->amount_due = $val->validated('amount_due');
				$sales_invoice->disc_total = $val->validated('disc_total');
				$sales_invoice->tax_total = $val->validated('tax_total');
				$sales_invoice->amount_paid = $val->validated('amount_paid');
				$sales_invoice->balance_due = $val->validated('balance_due');
				$sales_invoice->advance_paid = $val->validated('advance_paid');
				$sales_invoice->paid_status = $val->validated('paid_status');
				$sales_invoice->billing_address = $val->validated('billing_address');
				$sales_invoice->summary = $val->validated('summary');
				$sales_invoice->notes = $val->validated('notes');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sales_invoice', $sales_invoice, false);
		}

		$this->template->title = "Invoices";
		$this->template->content = View::forge('sales/invoice/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/sales-invoice');

		if ($sales_invoice = Model_Sales_Invoice::find($id))
		{
			Session::set_flash('error', 'You must remove source booking to delete invoice.');

			Response::redirect('registers/booking');
		}

		// else
		// {
		// 	Session::set_flash('error', 'Could not delete invoice #'.$id);
		// }

        // $sales_invoice->delete();

        // Session::set_flash('success', 'Deleted invoice #'.$id);
            
		Response::redirect('accounts/sales-invoice');

	}


}
