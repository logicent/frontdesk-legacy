<?php
class Controller_Users extends Controller_Authenticate
{
	public function action_index()
	{
		$data['users'] = Model_User::find('all', array('where' => array(
									array('group_id', 'in', array(3,5,6)),
								)));
		$this->template->title = "Users";
		$this->template->content = View::forge('users/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('users');

		if ( ! $data['user'] = Model_User::find($id))
		{
			Session::set_flash('error', 'Could not find user #'.$id);
			Response::redirect('users');
		}
		$this->template->title = "User";
		$this->template->content = View::forge('users/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('create');

			if ($val->run())
			{
				try {
                    // create a new user
                    Auth::create_user(
                        Input::post('username'),
                        Input::post('password'),
                        Input::post('email'),
                        Input::post('group_id'),
						array(
							'fullname' => Input::post('fullname'),
							'mobile' => Input::post('mobile'),
						)
                    );
                    Mailhelper::send(
                        Input::post('fullname'), 
                        Input::post('email'),
                        'FrontDesk: User Account Created',
                        'Hi, \r\n Your user account details has been created. \r\n Administrator'
                    );
                    Session::set_flash('success', e('Added user '.Input::post('username').'.'));

					Response::redirect('users');
                }
				catch (SimpleUserUpdateException $e)
				{
					Session::set_flash('error', e('User or email already exists'));
				}
				catch (SimpleUserWrongPassword $e)
				{
					Session::set_flash('error', e('Your Old password is invalid'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->title = "Users";
		$this->template->content = View::forge('users/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('users');

		if ( ! $user = Model_User::find($id))
		{
			Session::set_flash('error', 'Could not find user #'.$id);
			Response::redirect('users');
		}

		$val = Model_User::validate('edit');
        
		if ($val->run())
		{
			try {
                    // update a user
                    Auth::update_user(
                        array(
	                        'email' => Input::post('email'),
	                        // 'password' => Input::post('password'),
							// 'old_password' => Input::post('old_password'),
	                        'group_id' => Input::post('group_id'),
							array(
								'fullname' => Input::post('fullname'),
								// 'mobile' => Input::post('mobile'),
							)
                        ),
                    );
                    Mailhelper::send(
                                    Input::post('fullname'), 
                                    Input::post('email'),
                                    'FrontDesk: User Profile Updated',
                                    'Hi,Your user account details have been updated.Administrator'
                    );
                    Session::set_flash('success', e('Updated user '.Input::post('username').'.'));

					Response::redirect('dashboard');
            }
            catch (SimpleUserUpdateException $e)
            {
                Session::set_flash('error', e('User or email already exists'));
            }
			catch (SimpleUserWrongPassword $e)
			{
				Session::set_flash('error', e('Your Old password is invalid'));
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$user->username = $val->validated('username');
				$user->password = $val->validated('password');
				$user->old_password = $val->validated('old_password');
				$user->group_id = $val->validated('group_id');
				$user->email = $val->validated('email');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('user', $user, false);
		}
		$this->template->title = "Users";
		$this->template->content = View::forge('users/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('users');

		if ($user = Model_User::find($id))
		{
			try {
                // MUST use softDelete only
				Auth::delete_user($user->username);

				Session::set_flash('success', 'Deleted user #'.$id);
			}
			catch (SimpleUserUpdateException $e)
			{
				Session::set_flash('error', 'Could not delete user #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'User not found #'.$id);
        }
        
		Response::redirect('users');
	}
}
