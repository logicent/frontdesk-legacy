<?php
class Controller_Sales_Order extends Controller_Template
{

	public function action_index()
	{
		$data['sales_orders'] = Model_Sales_Order::find('all');
		$this->template->title = "Sales_orders";
		$this->template->content = View::forge('sales/order/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('sales/order');

		if ( ! $data['sales_order'] = Model_Sales_Order::find($id))
		{
			Session::set_flash('error', 'Could not find sales_order #'.$id);
			Response::redirect('sales/order');
		}

		$this->template->title = "Sales_order";
		$this->template->content = View::forge('sales/order/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Sales_Order::validate('create');

			if ($val->run())
			{
				$sales_order = Model_Sales_Order::forge(array(
				));

				if ($sales_order and $sales_order->save())
				{
					Session::set_flash('success', 'Added sales_order #'.$sales_order->id.'.');

					Response::redirect('sales/order');
				}

				else
				{
					Session::set_flash('error', 'Could not save sales_order.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Sales_Orders";
		$this->template->content = View::forge('sales/order/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('sales/order');

		if ( ! $sales_order = Model_Sales_Order::find($id))
		{
			Session::set_flash('error', 'Could not find sales_order #'.$id);
			Response::redirect('sales/order');
		}

		$val = Model_Sales_Order::validate('edit');

		if ($val->run())
		{

			if ($sales_order->save())
			{
				Session::set_flash('success', 'Updated sales_order #' . $id);

				Response::redirect('sales/order');
			}

			else
			{
				Session::set_flash('error', 'Could not update sales_order #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sales_order', $sales_order, false);
		}

		$this->template->title = "Sales_orders";
		$this->template->content = View::forge('sales/order/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('sales/order');

		if ($sales_order = Model_Sales_Order::find($id))
		{
			$sales_order->delete();

			Session::set_flash('success', 'Deleted sales_order #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete sales_order #'.$id);
		}

		Response::redirect('sales/order');

	}

}
