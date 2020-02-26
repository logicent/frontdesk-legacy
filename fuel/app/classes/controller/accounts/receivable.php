<?php
class Controller_Accounts_Receivable extends Controller_Authenticate
{

	public function action_index()
	{
		$data['receivables'] = Model_Accounts_Receivable::find('all');
		$this->template->title = "Receivables";
		$this->template->content = View::forge('accounts/receivable/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/receivable');

		if ( ! $data['receivable'] = Model_Accounts_Receivable::find($id))
		{
			Session::set_flash('error', 'Could not find receivable #'.$id);
			Response::redirect('accounts/receivable');
		}

		$this->template->title = "Receivable";
		$this->template->content = View::forge('accounts/receivable/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Accounts_Receivable::validate('create');

			if ($val->run())
			{
				$receivable = Model_Accounts_Receivable::forge(array(
				));

				if ($receivable and $receivable->save())
				{
					Session::set_flash('success', 'Added receivable #'.$receivable->id.'.');

					Response::redirect('accounts/receivable');
				}

				else
				{
					Session::set_flash('error', 'Could not save receivable.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Receivables";
		$this->template->content = View::forge('accounts/receivable/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/receivable');

		if ( ! $receivable = Model_Accounts_Receivable::find($id))
		{
			Session::set_flash('error', 'Could not find receivable #'.$id);
			Response::redirect('accounts/receivable');
		}

		$val = Model_Accounts_Receivable::validate('edit');

		if ($val->run())
		{

			if ($receivable->save())
			{
				Session::set_flash('success', 'Updated receivable #' . $id);

				Response::redirect('accounts/receivable');
			}

			else
			{
				Session::set_flash('error', 'Could not update receivable #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('receivable', $receivable, false);
		}

		$this->template->title = "Receivables";
		$this->template->content = View::forge('accounts/receivable/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/receivable');

		if ($receivable = Model_Accounts_Receivable::find($id))
		{
			$receivable->delete();

			Session::set_flash('success', 'Deleted receivable #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete receivable #'.$id);
		}

		Response::redirect('accounts/receivable');

	}

}
