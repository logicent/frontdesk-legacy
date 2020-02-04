<?php
class Controller_Customer extends Controller_Template
{

	public function action_index()
	{
		$data['customers'] = Model_Customer::find('all');
		$this->template->title = "Customers";
		$this->template->content = View::forge('customer/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('customer');

		if ( ! $data['customer'] = Model_Customer::find($id))
		{
			Session::set_flash('error', 'Could not find customer #'.$id);
			Response::redirect('customer');
		}

		$this->template->title = "Customer";
		$this->template->content = View::forge('customer/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Customer::validate('create');

			if ($val->run())
			{
				$customer = Model_Customer::forge(array(
				));

				if ($customer and $customer->save())
				{
					Session::set_flash('success', 'Added customer #'.$customer->id.'.');

					Response::redirect('customer');
				}

				else
				{
					Session::set_flash('error', 'Could not save customer.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Customers";
		$this->template->content = View::forge('customer/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('customer');

		if ( ! $customer = Model_Customer::find($id))
		{
			Session::set_flash('error', 'Could not find customer #'.$id);
			Response::redirect('customer');
		}

		$val = Model_Customer::validate('edit');

		if ($val->run())
		{

			if ($customer->save())
			{
				Session::set_flash('success', 'Updated customer #' . $id);

				Response::redirect('customer');
			}

			else
			{
				Session::set_flash('error', 'Could not update customer #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('customer', $customer, false);
		}

		$this->template->title = "Customers";
		$this->template->content = View::forge('customer/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('customer');

		if ($customer = Model_Customer::find($id))
		{
			$customer->delete();

			Session::set_flash('success', 'Deleted customer #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete customer #'.$id);
		}

		Response::redirect('customer');

	}

}
