<?php

class Controller_Sales_Order_Item extends Controller_Authenticate
{
	public function action_index()
	{
		$sales_order_items = Model_Sales_Order_Item::find('all');
		echo json_encode($sales_order_items);

	}

	public function action_create()
    {
        if (Input::is_ajax())
        {
			$data['row_id'] = Input::post('next_row_id');

            return View::forge('sales/order/item/_form', $data);
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
	// 		$val = Model_Sales_Order_Item::validate('create');

	// 		if ($val->run())
	// 		{
	// 			$sales_order_item = Model_Sales_Order_Item::forge(array(
	// 				'item_id' => Input::post('item_id'),
	// 				'order_id' => Input::post('order_id'),
	// 				'gl_account_id' => Input::post('gl_account_id'),
	// 				'description' => Input::post('description'),
	// 				'qty' => Input::post('qty'),
	// 				'unit_price' => Input::post('unit_price'),
	// 				'discount_percent' => Input::post('discount_percent'),
	// 				'amount' => Input::post('amount'),
	// 			));

	// 			if ($sales_order_item and $sales_order_item->save())
	// 			{
	// 				Session::set_flash('success', 'Added sales order item #'.$sales_order_item->id.'.');

	// 				Response::redirect('sales/order/item');
	// 			}

	// 			else
	// 			{
	// 				Session::set_flash('error', 'Could not save sales order item.');
	// 			}
	// 		}
	// 		else
	// 		{
	// 			Session::set_flash('error', $val->error());
	// 		}
	// 	}

	// 	echo json_encode($sales_order_item);

	// }

	// public function action_edit($id = null)
	// {
	// 	is_null($id) and Response::redirect('sales/order/item');

	// 	if ( ! $sales_order_item = Model_Sales_Order_Item::find($id))
	// 	{
	// 		Session::set_flash('error', 'Could not find sales order item #'.$id);
	// 		Response::redirect('sales/order/item');
	// 	}

	// 	$val = Model_Sales_Order_Item::validate('edit');

	// 	if ($val->run())
	// 	{
	// 		$sales_order_item->item_id = Input::post('item_id');
	// 		$sales_order_item->order_id = Input::post('order_id');
	// 		$sales_order_item->gl_account_id = Input::post('gl_account_id');
	// 		$sales_order_item->description = Input::post('description');
	// 		$sales_order_item->qty = Input::post('qty');
	// 		$sales_order_item->unit_price = Input::post('unit_price');
	// 		$sales_order_item->discount_percent = Input::post('discount_percent');
	// 		$sales_order_item->amount = Input::post('amount');

	// 		if ($sales_order_item->save())
	// 		{
	// 			Session::set_flash('success', 'Updated sales order item #' . $id);

	// 			Response::redirect('sales/order/item');
	// 		}

	// 		else
	// 		{
	// 			Session::set_flash('error', 'Could not update sales order item #' . $id);
	// 		}
	// 	}

	// 	else
	// 	{
	// 		if (Input::method() == 'POST')
	// 		{
	// 			$sales_order_item->item_id = $val->validated('item_id');
	// 			$sales_order_item->order_id = $val->validated('order_id');
	// 			$sales_order_item->gl_account_id = $val->validated('gl_account_id');
	// 			$sales_order_item->description = $val->validated('description');
	// 			$sales_order_item->qty = $val->validated('qty');
	// 			$sales_order_item->unit_price = $val->validated('unit_price');
	// 			$sales_order_item->discount_percent = $val->validated('discount_percent');
	// 			$sales_order_item->amount = $val->validated('amount');

	// 			Session::set_flash('error', $val->error());
	// 		}

	// 		$this->template->set_global('sales_order_item', $sales_order_item, false);
	// 	}

	// 	echo json_encode($sales_order_item);

	// }

	public function action_delete()
	{
        if (Input::is_ajax())
        {
			$id = Input::post('id');

			if ($sales_order_item = Model_Sales_Order_Item::find($id)) 
			{
				try {
					$sales_order_item->delete();
				}
				catch (Exception $e) {
					return $e->getMessage();
				}

				$msg = 'Deleted sales order item #'.$id;
			}
			else
			{
				$msg = 'Could not delete sales order item #'.$id;
			}
			
			return json_encode($msg);
		}
	}

}
