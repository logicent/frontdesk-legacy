<?php

class Controller_Login extends Controller_Template
{
	public $template = 'login';

	public function action_login()
	{
		// Already logged in
		Auth::check() and Response::redirect('dashboard');

		$val = Validation::forge();

		if (Input::method() == 'POST')
		{
			$val->add('email_username', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');

			if ($val->run())
			{
				$auth = Auth::instance();

				// check the credentials. This assumes that you have the previous table created
				if (Auth::check() or $auth->login(Input::post('email_username'), Input::post('password')))
				{
					// credentials ok, go right in
					if (Config::get('auth.driver', 'Simpleauth') == 'Ormauth')
					{
						//$current_user = Auth_User::find_by_username(Auth::get_screen_name());
						$current_user = Auth::check() ? Model\Auth_User::find_by_username(Auth::get_screen_name()) : null;
					}
					else
					{
						$current_user = Model_User::find_by_username(Auth::get_screen_name());
					}
					Session::set_flash('success', e('Welcome, '.$current_user->username));
					Response::redirect_back('dashboard');
				}
				else
				{
					Session::set_flash('error', e('You don\'t have access to the application'));
				}
			}
		}

        $business = Model_Business::find('first');
        // run test without business record to see if error occurs
        // is_null($business) and Response::redirect('business/create'); // should go to installer/setup
        $this->template->set_global('business', $business, false);

		$this->template->title = 'Login';
		$this->template->content = View::forge('login', array('val' => $val), false);
	}

	/**
	 * The logout action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		Auth::logout();
		Response::redirect('login');
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		Response::redirect('dashboard');
	}

}

/* End of file login.php */
