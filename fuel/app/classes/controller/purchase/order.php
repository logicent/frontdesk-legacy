<?php
class Controller_Purchase_Order extends Controller_Template
{

	public function action_index()
	{
		$data['purchase_orders'] = Model_Purchase_Order::find('all');
		$this->template->title = "Purchase_orders";
		$this->template->content = View::forge('purchase/order/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('purchase/order');

		if ( ! $data['purchase_order'] = Model_Purchase_Order::find($id))
		{
			Session::set_flash('error', 'Could not find purchase_order #'.$id);
			Response::redirect('purchase/order');
		}

		$this->template->title = "Purchase_order";
		$this->template->content = View::forge('purchase/order/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Purchase_Order::validate('create');

			if ($val->run())
			{
				$purchase_order = Model_Purchase_Order::forge(array(
				));

				if ($purchase_order and $purchase_order->save())
				{
					Session::set_flash('success', 'Added purchase_order #'.$purchase_order->id.'.');

					Response::redirect('purchase/order');
				}

				else
				{
					Session::set_flash('error', 'Could not save purchase_order.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Purchase_Orders";
		$this->template->content = View::forge('purchase/order/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('purchase/order');

		if ( ! $purchase_order = Model_Purchase_Order::find($id))
		{
			Session::set_flash('error', 'Could not find purchase_order #'.$id);
			Response::redirect('purchase/order');
		}

		$val = Model_Purchase_Order::validate('edit');

		if ($val->run())
		{

			if ($purchase_order->save())
			{
				Session::set_flash('success', 'Updated purchase_order #' . $id);

				Response::redirect('purchase/order');
			}

			else
			{
				Session::set_flash('error', 'Could not update purchase_order #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('purchase_order', $purchase_order, false);
		}

		$this->template->title = "Purchase_orders";
		$this->template->content = View::forge('purchase/order/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('purchase/order');

		if ($purchase_order = Model_Purchase_Order::find($id))
		{
			$purchase_order->delete();

			Session::set_flash('success', 'Deleted purchase_order #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete purchase_order #'.$id);
		}

		Response::redirect('purchase/order');

	}

}
