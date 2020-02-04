<?php
class Controller_Sales_Payment extends Controller_Template
{

	public function action_index()
	{
		$data['sales_payments'] = Model_Sales_Payment::find('all');
		$this->template->title = "Sales_payments";
		$this->template->content = View::forge('sales/payment/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('sales/payment');

		if ( ! $data['sales_payment'] = Model_Sales_Payment::find($id))
		{
			Session::set_flash('error', 'Could not find sales_payment #'.$id);
			Response::redirect('sales/payment');
		}

		$this->template->title = "Sales_payment";
		$this->template->content = View::forge('sales/payment/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Sales_Payment::validate('create');

			if ($val->run())
			{
				$sales_payment = Model_Sales_Payment::forge(array(
				));

				if ($sales_payment and $sales_payment->save())
				{
					Session::set_flash('success', 'Added sales_payment #'.$sales_payment->id.'.');

					Response::redirect('sales/payment');
				}

				else
				{
					Session::set_flash('error', 'Could not save sales_payment.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Sales_Payments";
		$this->template->content = View::forge('sales/payment/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('sales/payment');

		if ( ! $sales_payment = Model_Sales_Payment::find($id))
		{
			Session::set_flash('error', 'Could not find sales_payment #'.$id);
			Response::redirect('sales/payment');
		}

		$val = Model_Sales_Payment::validate('edit');

		if ($val->run())
		{

			if ($sales_payment->save())
			{
				Session::set_flash('success', 'Updated sales_payment #' . $id);

				Response::redirect('sales/payment');
			}

			else
			{
				Session::set_flash('error', 'Could not update sales_payment #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sales_payment', $sales_payment, false);
		}

		$this->template->title = "Sales_payments";
		$this->template->content = View::forge('sales/payment/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('sales/payment');

		if ($sales_payment = Model_Sales_Payment::find($id))
		{
			$sales_payment->delete();

			Session::set_flash('success', 'Deleted sales_payment #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete sales_payment #'.$id);
		}

		Response::redirect('sales/payment');

	}

}
