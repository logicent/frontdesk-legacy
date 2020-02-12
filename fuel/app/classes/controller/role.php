<?php
class Controller_Role extends Controller_Authenticate
{

	public function action_index()
	{
		$data['roles'] = Model_Role::find('all');
		$this->template->title = "Roles";
		$this->template->content = View::forge('role/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('role');

		if ( ! $data['role'] = Model_Role::find($id))
		{
			Session::set_flash('error', 'Could not find role #'.$id);
			Response::redirect('role');
		}

		$this->template->title = "Role";
		$this->template->content = View::forge('role/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Role::validate('create');

			if ($val->run())
			{
				$role = Model_Role::forge(array(
				));

				if ($role and $role->save())
				{
					Session::set_flash('success', 'Added role #'.$role->id.'.');

					Response::redirect('role');
				}

				else
				{
					Session::set_flash('error', 'Could not save role.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Roles";
		$this->template->content = View::forge('role/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('role');

		if ( ! $role = Model_Role::find($id))
		{
			Session::set_flash('error', 'Could not find role #'.$id);
			Response::redirect('role');
		}

		$val = Model_Role::validate('edit');

		if ($val->run())
		{

			if ($role->save())
			{
				Session::set_flash('success', 'Updated role #' . $id);

				Response::redirect('role');
			}

			else
			{
				Session::set_flash('error', 'Could not update role #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('role', $role, false);
		}

		$this->template->title = "Roles";
		$this->template->content = View::forge('role/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('role');

		if ($role = Model_Role::find($id))
		{
			$role->delete();

			Session::set_flash('success', 'Deleted role #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete role #'.$id);
		}

		Response::redirect('role');

	}

}
