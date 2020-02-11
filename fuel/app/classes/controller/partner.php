<?php
class Controller_Partner extends Controller_Authenticate
{

	public function action_index()
	{
		$data['partners'] = Model_Partner::find('all');
		$this->template->title = "Partners";
		$this->template->content = View::forge('partner/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('partner');

		if ( ! $data['partner'] = Model_Partner::find($id))
		{
			Session::set_flash('error', 'Could not find partner #'.$id);
			Response::redirect('partner');
		}

		$this->template->title = "Partner";
		$this->template->content = View::forge('partner/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Partner::validate('create');

			if ($val->run())
			{
				$partner = Model_Partner::forge(array(
					'name' => Input::post('name'),
					'type' => Input::post('type'),
					'inactive' => Input::post('inactive'),
					'credit_limit' => Input::post('credit_limit'),
				));

				if ($partner and $partner->save())
				{
					Session::set_flash('success', 'Added partner #'.$partner->id.'.');

					Response::redirect('partner');
				}

				else
				{
					Session::set_flash('error', 'Could not save partner.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Partners";
		$this->template->content = View::forge('partner/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('partner');

		if ( ! $partner = Model_Partner::find($id))
		{
			Session::set_flash('error', 'Could not find partner #'.$id);
			Response::redirect('partner');
		}

		$val = Model_Partner::validate('edit');

		if ($val->run())
		{
			$partner->name = Input::post('name');
			$partner->type = Input::post('type');
			$partner->inactive = Input::post('inactive');
			$partner->credit_limit = Input::post('credit_limit');

			if ($partner->save())
			{
				Session::set_flash('success', 'Updated partner #' . $id);

				Response::redirect('partner');
			}

			else
			{
				Session::set_flash('error', 'Could not update partner #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$partner->name = $val->validated('name');
				$partner->type = $val->validated('type');
				$partner->inactive = $val->validated('inactive');
				$partner->credit_limit = $val->validated('credit_limit');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('partner', $partner, false);
		}

		$this->template->title = "Partners";
		$this->template->content = View::forge('partner/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('partner');

		if ($partner = Model_Partner::find($id))
		{
			$partner->delete();

			Session::set_flash('success', 'Deleted partner #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete partner #'.$id);
		}

		Response::redirect('partner');

	}

}
