<?php
class Controller_Accounts_Taxescharges extends Controller_Authenticate
{

	public function action_index()
	{
		$data['taxescharges'] = Model_Accounts_Taxescharge::find('all');
		$this->template->title = "Taxescharges";
		$this->template->content = View::forge('accounts/taxescharges/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/taxescharges');

		if ( ! $data['taxescharge'] = Model_Accounts_Taxescharge::find($id))
		{
			Session::set_flash('error', 'Could not find taxescharge #'.$id);
			Response::redirect('accounts/taxescharges');
		}

		$this->template->title = "Taxescharge";
		$this->template->content = View::forge('accounts/taxescharges/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Taxescharge::validate('create');

			if ($val->run())
			{
				$taxescharge = Model_Accounts_Taxescharge::forge(array(
				));

				if ($taxescharge and $taxescharge->save())
				{
					Session::set_flash('success', 'Added taxescharge #'.$taxescharge->id.'.');

					Response::redirect('accounts/taxescharges');
				}

				else
				{
					Session::set_flash('error', 'Could not save taxescharge.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Taxescharges";
		$this->template->content = View::forge('accounts/taxescharges/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/taxescharges');

		if ( ! $taxescharge = Model_Accounts_Taxescharge::find($id))
		{
			Session::set_flash('error', 'Could not find taxescharge #'.$id);
			Response::redirect('accounts/taxescharges');
		}

		$val = Model_Accounts_Taxescharge::validate('edit');

		if ($val->run())
		{

			if ($taxescharge->save())
			{
				Session::set_flash('success', 'Updated taxescharge #' . $id);

				Response::redirect('accounts/taxescharges');
			}

			else
			{
				Session::set_flash('error', 'Could not update taxescharge #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('taxescharge', $taxescharge, false);
		}

		$this->template->title = "Taxescharges";
		$this->template->content = View::forge('accounts/taxescharges/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/taxescharges');

		if ($taxescharge = Model_Accounts_Taxescharge::find($id))
		{
			$taxescharge->delete();

			Session::set_flash('success', 'Deleted taxescharge #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete taxescharge #'.$id);
		}

		Response::redirect('accounts/taxescharges');

	}

}
