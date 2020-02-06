<?php
class Controller_Accounts_Tax extends Controller_Authenticate
{

	public function action_index()
	{
		$data['taxes'] = Model_Accounts_Tax::find('all');
		$this->template->title = "Taxes and Charges";
		$this->template->content = View::forge('accounts/taxcharge/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/taxes');

		if ( ! $data['tax_charge'] = Model_Accounts_Tax::find($id))
		{
			Session::set_flash('error', 'Could not find tax #'.$id);
			Response::redirect('accounts/taxes');
		}

		$this->template->title = "Taxes and Charges";
		$this->template->content = View::forge('accounts/taxcharge/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Tax::validate('create');

			if ($val->run())
			{
				$tax = Model_Accounts_Tax::forge(array(
					'code' => Input::post('code'),
					'tax_identifier' => Input::post('tax_identifier'),
					'tax_rate' => Input::post('tax_rate'),
				));

				if ($tax and $tax->save())
				{
					Session::set_flash('success', 'Added tax/charge #'.$tax->id.'.');

					Response::redirect('accounts/taxes');
				}

				else
				{
					Session::set_flash('error', 'Could not save tax/charge.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Taxes and Charges";
		$this->template->content = View::forge('accounts/taxcharge/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/taxes');

		if ( ! $tax_charge = Model_Accounts_Tax::find($id))
		{
			Session::set_flash('error', 'Could not find tax/charge #'.$id);
			Response::redirect('accounts/taxes');
		}

		$val = Model_Accounts_Tax::validate('edit');

		if ($val->run())
		{
            $tax_charge->code = Input::post('code');
            $tax_charge->tax_identifier = Input::post('tax_identifier');
            $tax_charge->tax_rate = Input::post('tax_rate');

			if ($tax_charge->save())
			{
				Session::set_flash('success', 'Updated taxes and charges #' . $id);

				Response::redirect('accounts/taxes');
			}

			else
			{
				Session::set_flash('error', 'Could not update tax/charge #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$tax_charge->code = $val->validated('code');
                $tax_charge->tax_identifier = $val->validated('tax_identifier');
                $tax_charge->tax_rate = $val->validated('tax_rate');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('tax_charge', $tax_charge, false);
		}

		$this->template->title = "Taxes and Charges";
		$this->template->content = View::forge('accounts/taxcharge/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/taxes');

		if ($tax = Model_Accounts_Tax::find($id))
		{
			$tax->delete();

			Session::set_flash('success', 'Deleted tax/charge #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete tax/charge #'.$id);
		}

		Response::redirect('accounts/taxes');

	}

}
