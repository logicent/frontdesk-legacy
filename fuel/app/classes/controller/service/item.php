<?php

class Controller_Service_Item extends Controller_Authenticate
{
	public function action_index()
	{
		$data['service_items'] = Model_Service_Item::find('all');
		$this->template->title = "Service items";
		$this->template->content = View::forge('service/item/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facilities/services');

		if ( ! $data['service_item'] = Model_Service_Item::find($id))
		{
			Session::set_flash('error', 'Could not find service item #'.$id);
			Response::redirect('facilities/services');
		}

		$this->template->title = "Service_item";
		$this->template->content = View::forge('service/item/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Service_Item::validate('create');

			if ($val->run())
			{
				$service_item = Model_Service_Item::forge(array(
					'code' => Input::post('code'),
					'gl_account_id' => Input::post('gl_account_id'),
					'description' => Input::post('description'),
					'qty' => Input::post('qty'),
					'unit_price' => Input::post('unit_price'),
                    'discount_percent' => Input::post('discount_percent'),
                    'fdesk_user' => Input::post('fdesk_user'),
                    'service_type' => Input::post('service_type'),
                    'billable' => Input::post('billable'),
                    'enabled' => Input::post('enabled'),
				));

				if ($service_item and $service_item->save())
				{
					Session::set_flash('success', 'Added service item #'.$service_item->code.'.');

					Response::redirect('facilities/services');
				}

				else
				{
					Session::set_flash('error', 'Could not save service item.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Service_Items";
		$this->template->content = View::forge('service/item/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facilities/services');

		if ( ! $service_item = Model_Service_Item::find($id))
		{
			Session::set_flash('error', 'Could not find service item #'.$id);
			Response::redirect('facilities/services');
		}

		$val = Model_Service_Item::validate('edit');

		if ($val->run())
		{
			$service_item->item = Input::post('code');
			$service_item->gl_account_id = Input::post('gl_account_id');
			$service_item->description = Input::post('description');
			$service_item->qty = Input::post('qty');
			$service_item->unit_price = Input::post('unit_price');
			$service_item->discount_percent = Input::post('discount_percent');
            $service_item->fdesk_user = Input::post('fdesk_user');
            $service_item->service_type = Input::post('service_type');
            $service_item->billable = Input::post('billable');
            $service_item->enabled = Input::post('enabled');

			if ($service_item->save())
			{
				Session::set_flash('success', 'Updated service item #' . $service_item->code);

				Response::redirect('facilities/services');
			}

			else
			{
				Session::set_flash('error', 'Could not update service item #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$service_item->item = $val->validated('code');
				$service_item->gl_account_id = $val->validated('gl_account_id');
				$service_item->description = $val->validated('description');
				$service_item->qty = $val->validated('qty');
				$service_item->unit_price = $val->validated('unit_price');
				$service_item->discount_percent = $val->validated('discount_percent');
                $service_item->fdesk_user = $val->validated('fdesk_user');
                $service_item->service_type = $val->validated('service_type');
                $service_item->billable = $val->validated('billable');
                $service_item->enabled = $val->validated('enabled');
                
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('service_item', $service_item, false);
		}

		$this->template->title = "Service_items";
		$this->template->content = View::forge('service/item/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facilities/services');

		if ($service_item = Model_Service_Item::find($id))
		{
			$sales_invoice_item = Model_Sales_Invoice_Item::find('first', array('where' => array('item_id' => $id)));
			if ($sales_invoice_item)
				Session::set_flash('error', 'Service item already in use by Invoice(s).');
			else
			{
				$service_item->delete();
				Session::set_flash('success', 'Deleted service item #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Could not delete service item #'.$id);
		}

		Response::redirect('facilities/services');

	}


}
