<?php
class Controller_Sales_Invoice extends Controller_Authenticate{

	public function action_index($show_del = false)
	{
		if ($show_del)
			$data['sales_invoices'] = Model_Sales_Invoice::deleted('all');
		else
		{
			$status = Input::get('status');
			if (!$status)
				$status = Model_Sales_Invoice::INVOICE_STATUS_OPEN;

			$data['sales_invoices'] = Model_Sales_Invoice::find('all', array('where' => array(
				array('status', '=', $status)), 'order_by' => array('invoice_num' => 'desc'), 'limit' => 1000));
		}

		$data['status'] = $status;

		$this->template->title = "Guest Invoices";
		$this->template->content = View::forge('sales/invoice/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('sales/invoice');

		if ( ! $data['sales_invoice'] = Model_Sales_Invoice::find($id))
		{
			Session::set_flash('error', 'Could not find guest invoice #'.$id);
			Response::redirect('sales/invoice');
		}

		$this->template->title = "Guest Invoice";
		$this->template->content = View::forge('sales/invoice/view', $data);

	}

	public function action_create($bk_id = null)
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
					'booking_id' => Input::post('booking_id'),
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
					Session::set_flash('success', 'Added guest invoice #'.$sales_invoice->id.'.');

					Response::redirect('sales/invoice');
				}

				else
				{
					Session::set_flash('error', 'Could not save guest invoice.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$booking = Model_Fd_Booking::find($bk_id);
		$this->template->set_global('booking', $booking, false);

		// prepare guest invoice item as global variable
		$sales_invoice_item = Model_Sales_Invoice_Item::forge();
		$this->template->set_global('sales_invoice_item', $sales_invoice_item, false);

		// get default billable item
		$services = DB::select('id','item')->from('service_item')->execute()->as_array();
		$this->template->set_global('serviceItems', json_encode($services), false);

		$this->template->title = "Guest Invoices";
		$this->template->content = View::forge('sales/invoice/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('sales/invoice');

		if ( ! $sales_invoice = Model_Sales_Invoice::find($id))
		{
			Session::set_flash('error', 'Could not find guest invoice #'.$id);
			Response::redirect('sales/invoice');
		}

		$val = Model_Sales_Invoice::validate('edit');

		if ($val->run())
		{
			$sales_invoice->invoice_num = Input::post('invoice_num');
			$sales_invoice->po_number = Input::post('po_number');
			$sales_invoice->amounts_tax_inc = Input::post('amounts_tax_inc');
			$sales_invoice->issue_date = Input::post('issue_date');
			$sales_invoice->due_date = Input::post('due_date');
			$sales_invoice->status = Input::post('status');
			$sales_invoice->booking_id = Input::post('booking_id');
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
				Session::set_flash('success', 'Updated guest invoice #' . $id);

				Response::redirect('sales/invoice');
			}

			else
			{
				Session::set_flash('error', 'Could not update guest invoice #' . $id);
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
				$sales_invoice->booking_id = $val->validated('booking_id');
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

		$this->template->title = "Guest Invoices";
		$this->template->content = View::forge('sales/invoice/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('sales/invoice');

		if ($sales_invoice = Model_Sales_Invoice::find($id))
		{
			Session::set_flash('error', 'You must remove parent booking to delete invoice.');

			Response::redirect('frontdesk/bookings');
			// $sales_invoice->delete();

			// Session::set_flash('success', 'Deleted guest invoice #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete guest invoice #'.$id);
		}

		Response::redirect('sales/invoice');

	}


}
