<?php
class Controller_Accounts_Paymentmethod extends Controller_Authenticate
{

	public function action_index()
	{
		$data['paymentmethods'] = Model_Accounts_Paymentmethod::find('all');
		$this->template->title = "Paymentmethods";
		$this->template->content = View::forge('accounts/paymentmethod/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/paymentmethod');

		if ( ! $data['paymentmethod'] = Model_Accounts_Paymentmethod::find($id))
		{
			Session::set_flash('error', 'Could not find paymentmethod #'.$id);
			Response::redirect('accounts/paymentmethod');
		}

		$this->template->title = "Paymentmethod";
		$this->template->content = View::forge('accounts/paymentmethod/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Paymentmethod::validate('create');

			if ($val->run())
			{
				$paymentmethod = Model_Accounts_Paymentmethod::forge(array(
				));

				if ($paymentmethod and $paymentmethod->save())
				{
					Session::set_flash('success', 'Added paymentmethod #'.$paymentmethod->id.'.');

					Response::redirect('accounts/paymentmethod');
				}

				else
				{
					Session::set_flash('error', 'Could not save paymentmethod.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Paymentmethods";
		$this->template->content = View::forge('accounts/paymentmethod/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/paymentmethod');

		if ( ! $paymentmethod = Model_Accounts_Paymentmethod::find($id))
		{
			Session::set_flash('error', 'Could not find paymentmethod #'.$id);
			Response::redirect('accounts/paymentmethod');
		}

		$val = Model_Accounts_Paymentmethod::validate('edit');

		if ($val->run())
		{

			if ($paymentmethod->save())
			{
				Session::set_flash('success', 'Updated paymentmethod #' . $id);

				Response::redirect('accounts/paymentmethod');
			}

			else
			{
				Session::set_flash('error', 'Could not update paymentmethod #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('paymentmethod', $paymentmethod, false);
		}

		$this->template->title = "Paymentmethods";
		$this->template->content = View::forge('accounts/paymentmethod/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/paymentmethod');

		if ($paymentmethod = Model_Accounts_Paymentmethod::find($id))
		{
			$paymentmethod->delete();

			Session::set_flash('success', 'Deleted paymentmethod #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete paymentmethod #'.$id);
		}

		Response::redirect('accounts/paymentmethod');

	}

}
