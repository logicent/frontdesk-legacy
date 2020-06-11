<?php

class Controller_Sales_Order extends Controller_Authenticate
{
	public function action_index($show_del = false)
	{
		if ($show_del)
			$data['sales_orders'] = Model_Sales_Order::deleted('all');
		else
		{
			$status = Input::get('status');
			if (!$status)
				$status = Model_Sales_Order::ORDER_STATUS_OPEN;

            $data['sales_orders'] = Model_Sales_Order::find('all', 
                                        array('where' => array(
                                            array('status', '=', $status)
                                        ), 
                                        'order_by' => array('order_num' => 'desc'), 
                                        'limit' => 1000));
		}
		$data['status'] = $status;
        
		$this->template->title = "Orders";
		$this->template->content = View::forge('sales/order/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/sales-order');

		if ( ! $data['sales_order'] = Model_Sales_Order::find($id))
		{
			Session::set_flash('error', 'Could not find order #'.$id);
			Response::redirect('accounts/sales-order');
		}
		$this->template->title = "Order";
		$this->template->content = View::forge('sales/order/view', $data);
	}

	public function action_create($id = null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Sales_Order::validate('create');

			if ($val->run())
			{
				$sales_order = Model_Sales_Order::forge(array(
					'order_num' => Input::post('order_num'),
					'po_number' => Input::post('po_number'),
					'amounts_tax_inc' => Input::post('amounts_tax_inc'),
					'issue_date' => Input::post('issue_date'),
					'due_date' => Input::post('due_date'),
					'status' => Input::post('status'),
					// 'source' => Input::post('source'),
					// 'source_id' => Input::post('source_id'),
					'customer_name' => Input::post('customer_name'),
					'unit_name' => Input::post('unit_name'),
					'amount_due' => Input::post('amount_due'),
					'disc_total' => Input::post('disc_total'),
					'tax_total' => Input::post('tax_total'),
					'amount_paid' => Input::post('amount_paid'),
					'balance_due' => Input::post('balance_due'),
					'advance_paid' => Input::post('advance_paid'),
					'paid_status' => Input::post('paid_status'),
					'shipping_address' => Input::post('shipping_address'),
					'summary' => Input::post('summary'),
					'notes' => Input::post('notes'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				try 
				{
					DB::start_transaction();
					if ($sales_order and $sales_order->save())
					{
						// save the line item(s)
						for ($i=1; $i < count(Input::post('item_id')); $i++)
						{
							$sales_order_item = Model_Sales_Order_Item::forge(array(
								'item_id' => Input::post("item_id")[$i],
								'qty' => Input::post("qty")[$i],
								'unit_price' => Input::post("unit_price")[$i],
								'amount' => Input::post("amount")[$i],
								'order_id' => $sales_order->id,
								'discount_percent' => Input::post("discount_percent")[$i],
								'gl_account_id' => null, // Input::post("gl_account_id")[$i],
								'description' => Input::post("description")[$i],
							));
							$sales_order_item->save();
						}
						DB::commit_transaction();
						
						Session::set_flash('success', 'Added order #'.$sales_order->id.'.');
						Response::redirect('accounts/sales-order');
					}
					else
					{
						Session::set_flash('error', 'Could not save order.');
					}
				}
				catch (Fuel\Core\Database_Exception $e)
				{
					DB::rollback_transaction();
					Session::set_flash('error', $e->getMessage());
					// throw $e;
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

		// prepare order item as global variable
		$sales_order_item = Model_Sales_Order_Item::forge();
		$this->template->set_global('sales_order_item', $sales_order_item, false);

		// get default billable and enabled item
        $services = DB::select('id','code')
                        ->from('service_item')
                        ->where(array('billable' => true, 'enabled' => true))
                        ->execute()
						->as_array();

		$this->template->set_global('service_item', json_encode($services), false);

		$this->template->title = "Orders";
		$this->template->content = View::forge('sales/order/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/sales-order');

		if ( ! $sales_order = Model_Sales_Order::find($id))
		{
			Session::set_flash('error', 'Could not find order #'.$id);
			Response::redirect('accounts/sales-order');
		}
		
		$val = Model_Sales_Order::validate('edit');
		
		if ($val->run())
		{
			$sales_order->order_num = Input::post('order_num');
			$sales_order->po_number = Input::post('po_number');
			$sales_order->amounts_tax_inc = Input::post('amounts_tax_inc');
			$sales_order->issue_date = Input::post('issue_date');
			$sales_order->due_date = Input::post('due_date');
			$sales_order->status = Input::post('status');
			// $sales_order->source = Input::post('source');
			// $sales_order->source_id = Input::post('source_id');
			$sales_order->customer_name = Input::post('customer_name');
			$sales_order->unit_name = Input::post('unit_name');
			$sales_order->amount_due = Input::post('amount_due');
			$sales_order->disc_total = Input::post('disc_total');
			$sales_order->tax_total = Input::post('tax_total');
			$sales_order->amount_paid = Input::post('amount_paid');
			$sales_order->balance_due = Input::post('balance_due');
			$sales_order->advance_paid = Input::post('advance_paid');
			$sales_order->paid_status = Input::post('paid_status');
			$sales_order->shipping_address = Input::post('shipping_address');
			$sales_order->summary = Input::post('summary');
			$sales_order->notes = Input::post('notes');
			$sales_order->fdesk_user = Input::post('fdesk_user');

			// update Order Amounts if discounted
			Model_Sales_Order::applyDiscountAmount($sales_order);
		
			try {
				DB::start_transaction();
			
				if ($sales_order->save())
				{
					// save the line item(s)
					for ($i=1; $i < count(Input::post('item_id')); $i++)
					{
						if ( ! $sales_order_item = Model_Sales_Order_item::find($id) )
						{
							$sales_order_item = Model_Sales_Order_Item::forge(array(
								'item_id' => Input::post("item_id")[$i],
								'qty' => Input::post("qty")[$i],
								'unit_price' => Input::post("unit_price")[$i],
								'amount' => Input::post("amount")[$i],
								'order_id' => $sales_order->id,
								'discount_percent' => Input::post("discount_percent")[$i],
								'gl_account_id' => null, // Input::post("gl_account_id")[$i],
								'description' => Input::post("description")[$i],
							));
						}
						else {
							$sales_order_item->item_id = Input::post('item_id')[$i];
							$sales_order_item->qty = Input::post('qty')[$i];
							$sales_order_item->unit_price = Input::post('unit_price')[$i];
							$sales_order_item->amount = Input::post('amount')[$i];
							$sales_order_item->order_id = Input::post('order_id')[$i];
							$sales_order_item->discount_percent = Input::post('discount_percent')[$i];
							$sales_order_item->gl_account_id = null; // Input::post('gl_account_id')[$i];
							$sales_order_item->description = Input::post('description')[$i];
						}

						$sales_order_item->save();
					}

					DB::commit_transaction();
	
					Session::set_flash('success', 'Updated order #' . $id);
				}
				else
				{
					Session::set_flash('error', 'Could not update order #' . $id);
				}
				
				Response::redirect('accounts/sales-order');
			}
			catch (Fuel\Core\Database_Exception $e)
			{
				DB::rollback_transaction();

				Session::set_flash('error', $e->getMessage());
				// throw $e;
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$sales_order->order_num = $val->validated('order_num');
				$sales_order->po_number = $val->validated('po_number');
				$sales_order->amounts_tax_inc = $val->validated('amounts_tax_inc');
				$sales_order->issue_date = $val->validated('issue_date');
				$sales_order->due_date = $val->validated('due_date');
				$sales_order->status = $val->validated('status');
				// $sales_order->source = $val->validated('source');
				// $sales_order->source_id = $val->validated('source_id');
                $sales_order->customer_name = $val->validated('customer_name');
			    $sales_order->unit_name = $val->validated('unit_name');
				$sales_order->amount_due = $val->validated('amount_due');
				$sales_order->disc_total = $val->validated('disc_total');
				$sales_order->tax_total = $val->validated('tax_total');
				$sales_order->amount_paid = $val->validated('amount_paid');
				$sales_order->balance_due = $val->validated('balance_due');
				$sales_order->advance_paid = $val->validated('advance_paid');
				$sales_order->paid_status = $val->validated('paid_status');
				$sales_order->shipping_address = $val->validated('shipping_address');
				$sales_order->summary = $val->validated('summary');
				$sales_order->notes = $val->validated('notes');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('sales_order', $sales_order, false);
		}
		
		$this->template->title = "Orders";
		$this->template->content = View::forge('sales/order/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/sales-order');

		if ($sales_order = Model_Sales_Order::find($id))
		{
	        $result = $sales_order->delete();
			
	        Session::set_flash('success', 'Deleted order #'.$id);
		}
		else
		{
			Session::set_flash('error', 'Could not delete order #'.$id);
		}
        
		Response::redirect('accounts/sales-order');
	}
}
