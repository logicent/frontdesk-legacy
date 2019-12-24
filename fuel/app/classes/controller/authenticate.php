<?php
class Controller_Authenticate extends Controller_Template
{
    private $driver = 'ormauth';

    public function before()
    {
        parent::before();

        if (Request::active()->controller !== 'Controller_Dashboard' or ! in_array(Request::active()->action, array('login', 'logout')))
        {
            if ( ! Auth::check())
            {
                Response::redirect('login');
            }
            else
            {
            //    $admin_group_id = Auth::instance()->get_config('driver', false) == 'Ormauth' ? 6 : 100;
            // use switch case to allow other user groups in backend
                switch (Config::get('auth.driver'))
                {
                    case 'Ormauth':
                            if (Auth::member(6)) $admin_group_id = 6; // Super Admin (1 only)
                            elseif (Auth::member(5)) $admin_group_id = 5; // Admins
                            elseif (Auth::member(3)) $admin_group_id = 3; // Users
                        break;
                    default: // Simpleauth
                        $admin_group_id = 100;
                }
                if ( ! Auth::member($admin_group_id))
                {
                    Session::set_flash('error', e('You don\'t have access to the application'));
                    Response::redirect('/');
                }
            }
        }

        list(, $userid) = Auth::get_user_id();
        $this->template->set_global('uid', $userid, false);
        $name = Auth::get_screen_name();
        $this->template->set_global('uname', $name, false);
        $group = Auth::get_groups();
        $this->template->set_global('ugroup', $group[0][1], false);

        $business = Model_Business::find('first');
        //is_null($business) and Response::redirect('business/create'); // should go to installer/setup

        $this->template->set_global('business', $business, false);
    }

}

/* End of file login.php */
