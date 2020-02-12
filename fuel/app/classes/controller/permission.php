<?php
class Controller_Permission extends Controller_Authenticate
{

	public function action_index()
	{
		$data['permissions'] = Model_Permission::find('all');
		$this->template->title = "Permissions";
		$this->template->content = View::forge('permission/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('permission');

		if ( ! $data['permission'] = Model_Permission::find($id))
		{
			Session::set_flash('error', 'Could not find permission #'.$id);
			Response::redirect('permission');
		}

		$this->template->title = "Permission";
		$this->template->content = View::forge('permission/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Permission::validate('create');

			if ($val->run())
			{
				$permission = Model_Permission::forge(array(
				));

				if ($permission and $permission->save())
				{
					Session::set_flash('success', 'Added permission #'.$permission->id.'.');

					Response::redirect('permission');
				}

				else
				{
					Session::set_flash('error', 'Could not save permission.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Permissions";
		$this->template->content = View::forge('permission/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('permission');

		if ( ! $permission = Model_Permission::find($id))
		{
			Session::set_flash('error', 'Could not find permission #'.$id);
			Response::redirect('permission');
		}

		$val = Model_Permission::validate('edit');

		if ($val->run())
		{

			if ($permission->save())
			{
				Session::set_flash('success', 'Updated permission #' . $id);

				Response::redirect('permission');
			}

			else
			{
				Session::set_flash('error', 'Could not update permission #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('permission', $permission, false);
		}

		$this->template->title = "Permissions";
		$this->template->content = View::forge('permission/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('permission');

		if ($permission = Model_Permission::find($id))
		{
			$permission->delete();

			Session::set_flash('success', 'Deleted permission #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete permission #'.$id);
		}

		Response::redirect('permission');

	}

}
