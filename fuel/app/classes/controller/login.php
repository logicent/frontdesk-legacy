<?php

class Controller_Login extends Controller_Template
{
	public $template = 'template_login';

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
		$this->template->content = View::forge('login/login', array('val' => $val), false);
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
        
        // TODO: implement the logout process as shown below:

        // remove the remember-me cookie, we logged-out on purpose
        \Auth::dont_remember_me();

        // logout
        \Auth::logout();

        // inform the user the logout was successful
        \Messages::success(__('login.logged-out'));

        // and go back to where you came from (or the application
        // homepage if no previous page can be determined)
        \Response::redirect_back();
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

    // public function action_reset_password()
    // {
    //     // reset the password for the current user
    //     $new_password = Auth::reset_password('thisusername');
    // }

    public function action_lostpassword($hash = null)
    {
        $val = Validation::forge();

        // was the lostpassword form posted?
		if (Input::method() == 'POST')
		{
            // do we have a posted email address?
            if ($email = Input::post('email'))
            {
                $val->add('email', 'Email')
			        ->add_rule('required');

                if ($val->run())
                {                
                    // do we know this user?
                    if ($user = \Model\Auth_User::find_by_email($email))
                    {
                        // generate a recovery hash
                        $hash = Auth::instance()->hash_password(\Str::random()).$user->id;

                        // and store it in the user profile
                        Auth::update_user(
                            array(
                                'lostpassword_hash' => $hash,
                                'lostpassword_created' => time()
                            ),
                            $user->username
                        );

                        // send an email out with a reset link
                        // \Package::load('email'); // always load via config
                        $email = Email::forge();

                        // use a view file to generate the email message
                        $email->html_body(
                            // Theme::instance()->view('login/lostpassword')
                            View::forge('login/mail_lostpassword')
                                ->set('url', Uri::create('login/lostpassword/' . base64_encode($hash) . '/'), false)
                                ->set('user', $user, false)
                                ->render()
                        );

                        // give it a subject
                        // $email->subject(__('login.password-recovery'));
                        $email->subject('FrontDesk Password Reset');

                        // add from- and to address
                        // $from = Config::get('application.email-addresses.from.website', 'support@logicent.co');
                        
                        // $email->from($from['email'], $from['name']);
                        $email->from('support@logicent.co', 'Support @ Logicent');
                        $email->to($user->email, $user->fullname);

                        // and off it goes (if all goes well)!
                        try
                        {
                            // send the email
                            $email->send();
                        }
                        // this should never happen, a users email was validated, right?
                        catch(EmailValidationFailedException $e)
                        {
                            // \Messages::error(__('login.invalid-email-address'));
                            Session::set_flash('error', 'Invalid email address');
                            Response::redirect_back();
                        }
                        // what went wrong now?
                        catch(\Exception $e)
                        {
                            // log the error so an administrator can have a look
                            logger(Fuel::L_ERROR, '*** Error sending email ('.__FILE__.'#'.__LINE__.'): '.$e->getMessage());

                            // \Messages::error(__('login.error-sending-email'));
                            Session::set_flash('error', 'Error sending email');
                            Response::redirect_back();
                        }
                    }
                }
            }
            // posted form, but email address posted?
            else
            {
                // inform the user and fall through to the form
                // \Messages::error(__('login.error-missing-email'));
                Session::set_flash('error', 'Error missing email address');
            }
            // inform the user an email is on the way (or not ;-))
            // \Messages::info(__('login.recovery-email-send'));
            Session::set_flash('info', 'Recovery email has been sent');
            Response::redirect_back();
        }
        // no form posted, do we have a hash passed in the URL?
        elseif ($hash !== null)
        {
            // decode the hash
            $hash = base64_decode($hash);

            // get the userid from the hash
            $user = substr($hash, 44);

            // and find the user with this id
            if ($user = \Model\Auth_User::find_by_id($user))
            {
                // do we have this hash for this user, and hasn't it expired yet (we allow for 24 hours response)?
                if (isset($user->lostpassword_hash) and $user->lostpassword_hash == $hash and time() - $user->lostpassword_created < 86400)
                {
                    // invalidate the hash
                    Auth::update_user(
                        array(
                            'lostpassword_hash' => null,
                            'lostpassword_created' => null
                        ),
                        $user->username
                    );

                    // log the user in and go to the profile to change the password
                    if (Auth::instance()->force_login($user->id))
                    {
                        // \Messages::info(__('login.password-recovery-accepted'));
                        Session::set_flash('info', 'Password recovery accepted');
                        Response::redirect('users/edit/' . $user->id);
                    }
                }
            }
            // something wrong with the hash
            // \Messages::error(__('login.recovery-hash-invalid'));
            Session::set_flash('error', 'Recovery hash is invalid');
            Response::redirect_back();
        }
        // no form posted, and no hash present. no clue what we do here
        // else
        // {
            // \Response::redirect_back();
            $this->template->title = 'Forgot Password';
            $this->template->content = View::forge('login/lostpassword', array('val' => $val), false);
        // }
    }
}

/* End of file login.php */
