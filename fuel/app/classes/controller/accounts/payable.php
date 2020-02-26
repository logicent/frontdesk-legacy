<?php
class Controller_Accounts_Payable extends Controller_Authenticate
{

	public function action_index()
	{
		$data['payables'] = Model_Accounts_Payable::find('all');
		$this->template->title = "Payables";
		$this->template->content = View::forge('accounts/payable/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/payable');

		if ( ! $data['payable'] = Model_Accounts_Payable::find($id))
		{
			Session::set_flash('error', 'Could not find payable #'.$id);
			Response::redirect('accounts/payable');
		}

		$this->template->title = "Payable";
		$this->template->content = View::forge('accounts/payable/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Payable::validate('create');

			if ($val->run())
			{
				$payable = Model_Accounts_Payable::forge(array(
				));

				if ($payable and $payable->save())
				{
					Session::set_flash('success', 'Added payable #'.$payable->id.'.');

					Response::redirect('accounts/payable');
				}

				else
				{
					Session::set_flash('error', 'Could not save payable.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Payables";
		$this->template->content = View::forge('accounts/payable/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/payable');

		if ( ! $payable = Model_Accounts_Payable::find($id))
		{
			Session::set_flash('error', 'Could not find payable #'.$id);
			Response::redirect('accounts/payable');
		}

		$val = Model_Accounts_Payable::validate('edit');

		if ($val->run())
		{

			if ($payable->save())
			{
				Session::set_flash('success', 'Updated payable #' . $id);

				Response::redirect('accounts/payable');
			}

			else
			{
				Session::set_flash('error', 'Could not update payable #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('payable', $payable, false);
		}

		$this->template->title = "Payables";
		$this->template->content = View::forge('accounts/payable/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/payable');

		if ($payable = Model_Accounts_Payable::find($id))
		{
			$payable->delete();

			Session::set_flash('success', 'Deleted payable #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete payable #'.$id);
		}

		Response::redirect('accounts/payable');

	}

}
