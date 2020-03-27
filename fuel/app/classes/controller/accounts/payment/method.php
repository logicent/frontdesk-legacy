<?php
class Controller_Accounts_Payment_Method extends Controller_Authenticate
{

	public function action_index()
	{
		$data['payment_methods'] = Model_Accounts_Payment_Method::find('all');
		$this->template->title = "Payment Methods";
		$this->template->content = View::forge('accounts/payment/method/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/payment-method');

		if ( ! $data['payment_method'] = Model_Accounts_Payment_Method::find($id))
		{
			Session::set_flash('error', 'Could not find payment method #'.$id);
			Response::redirect('accounts/payment-method');
		}

		$this->template->title = "Payment Methods";
		$this->template->content = View::forge('accounts/payment/method/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Payment_Method::validate('create');

			if ($val->run())
			{
				$payment_method = Model_Accounts_Payment_Method::forge(array(
					'code' => Input::post('code'),
					'name' => Input::post('name'),
					'is_default' => Input::post('is_default'),
					'enabled' => Input::post('enabled'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($payment_method and $payment_method->save())
				{
					Session::set_flash('success', 'Added payment method #'.$payment_method->name.'.');
					Response::redirect('accounts/payment-method');
				}
				else
				{
					Session::set_flash('error', 'Could not save payment method.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Payment Methods";
		$this->template->content = View::forge('accounts/payment/method/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/payment-method');

		if ( ! $payment_method = Model_Accounts_Payment_Method::find($id))
		{
			Session::set_flash('error', 'Could not find payment method #'.$id);
			Response::redirect('accounts/payment-method');
		}

		$val = Model_Accounts_Payment_Method::validate('edit');

		if ($val->run())
		{
            $payment_method->code = Input::post('code');
            $payment_method->name = Input::post('name');
            $payment_method->is_default = Input::post('is_default');
            $payment_method->enabled = Input::post('enabled');

			if ($payment_method->save())
			{
				Session::set_flash('success', 'Updated payment method #' . $payment_method->name);

				Response::redirect('accounts/payment-method');
			}
			else
			{
				Session::set_flash('error', 'Could not update payment method #' . $id);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$payment_method->code = $val->validated('code');
                $payment_method->name = $val->validated('name');
                $payment_method->is_default = $val->validated('is_default');
                $payment_method->enabled = $val->validated('enabled');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('payment_method', $payment_method, false);
		}

		$this->template->title = "Payment Methods";
		$this->template->content = View::forge('accounts/payment/method/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/payment-method');

		if (Input::method() == 'POST')
		{
			if ($payment_method = Model_Accounts_Payment_Method::find($id))
			{
				$payment_method->delete();

				Session::set_flash('success', 'Deleted payment method #'.$id);
			}
			else
			{
				Session::set_flash('error', 'Could not delete payment method #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}

		Response::redirect('accounts/payment-method');

	}

}
