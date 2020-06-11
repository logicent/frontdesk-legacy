<?php

class Controller_Sales_Invoice_Item extends Controller_Authenticate
{
	public function action_index()
	{
		$sales_invoice_items = Model_Sales_Invoice_Item::find('all');
		echo json_encode($sales_invoice_items);
	}

	public function action_create()
    {
        if (Input::is_ajax())
        {
			$data['row_id'] = Input::post('next_row_id');
            return View::forge('sales/invoice/item/_form', $data);
        }
	}
	
	public function action_read()
    {
		$item = '';
		
        if (Input::is_ajax())
        {
            $item = Model_Service_Item::query()
										->where(
											array('id' => Input::post('item_id'))
										)
										->get_one()
										->to_array();
		}
		
		return json_encode($item);
	}

	// public function action_create()
	// {
	// 	if (Input::method() == 'POST')
	// 	{
	// 		$val = Model_Sales_Invoice_Item::validate('create');

	// 		if ($val->run())
	// 		{
	// 			$sales_invoice_item = Model_Sales_Invoice_Item::forge(array(
	// 				'item_id' => Input::post('item_id'),
	// 				'invoice_id' => Input::post('invoice_id'),
	// 				'gl_account_id' => Input::post('gl_account_id'),
	// 				'description' => Input::post('description'),
	// 				'qty' => Input::post('qty'),
	// 				'unit_price' => Input::post('unit_price'),
	// 				'discount_percent' => Input::post('discount_percent'),
	// 				'amount' => Input::post('amount'),
	// 			));

	// 			if ($sales_invoice_item and $sales_invoice_item->save())
	// 			{
	// 				Session::set_flash('success', 'Added sales invoice item #'.$sales_invoice_item->id.'.');

	// 				Response::redirect('sales/invoice/item');
	// 			}

	// 			else
	// 			{
	// 				Session::set_flash('error', 'Could not save sales invoice item.');
	// 			}
	// 		}
	// 		else
	// 		{
	// 			Session::set_flash('error', $val->error());
	// 		}
	// 	}

	// 	echo json_encode($sales_invoice_item);

	// }

	// public function action_edit($id = null)
	// {
	// 	is_null($id) and Response::redirect('sales/invoice/item');

	// 	if ( ! $sales_invoice_item = Model_Sales_Invoice_Item::find($id))
	// 	{
	// 		Session::set_flash('error', 'Could not find sales invoice item #'.$id);
	// 		Response::redirect('sales/invoice/item');
	// 	}

	// 	$val = Model_Sales_Invoice_Item::validate('edit');

	// 	if ($val->run())
	// 	{
	// 		$sales_invoice_item->item_id = Input::post('item_id');
	// 		$sales_invoice_item->invoice_id = Input::post('invoice_id');
	// 		$sales_invoice_item->gl_account_id = Input::post('gl_account_id');
	// 		$sales_invoice_item->description = Input::post('description');
	// 		$sales_invoice_item->qty = Input::post('qty');
	// 		$sales_invoice_item->unit_price = Input::post('unit_price');
	// 		$sales_invoice_item->discount_percent = Input::post('discount_percent');
	// 		$sales_invoice_item->amount = Input::post('amount');

	// 		if ($sales_invoice_item->save())
	// 		{
	// 			Session::set_flash('success', 'Updated sales invoice item #' . $id);

	// 			Response::redirect('sales/invoice/item');
	// 		}

	// 		else
	// 		{
	// 			Session::set_flash('error', 'Could not update sales invoice item #' . $id);
	// 		}
	// 	}

	// 	else
	// 	{
	// 		if (Input::method() == 'POST')
	// 		{
	// 			$sales_invoice_item->item_id = $val->validated('item_id');
	// 			$sales_invoice_item->invoice_id = $val->validated('invoice_id');
	// 			$sales_invoice_item->gl_account_id = $val->validated('gl_account_id');
	// 			$sales_invoice_item->description = $val->validated('description');
	// 			$sales_invoice_item->qty = $val->validated('qty');
	// 			$sales_invoice_item->unit_price = $val->validated('unit_price');
	// 			$sales_invoice_item->discount_percent = $val->validated('discount_percent');
	// 			$sales_invoice_item->amount = $val->validated('amount');

	// 			Session::set_flash('error', $val->error());
	// 		}

	// 		$this->template->set_global('sales_invoice_item', $sales_invoice_item, false);
	// 	}

	// 	echo json_encode($sales_invoice_item);

	// }

	public function action_delete()
	{
        if (Input::is_ajax())
        {
			$id = Input::post('id');

			if ($sales_invoice_item = Model_Sales_Invoice_Item::find($id)) 
			{
				try {
					$sales_invoice_item->delete();
				}
				catch (Exception $e) {
					return $e->getMessage();
				}

				$msg = 'Deleted sales invoice item #'.$id;
			}
			else
			{
				$msg = 'Could not delete sales invoice item #'.$id;
			}
			
			return json_encode($msg);
		}
	}

}
