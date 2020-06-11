<?php
class Controller_Authenticate extends Controller_Template
{
    private $driver = 'ormauth';

    public $userid;
    public $uname;
    public $ugroup;
    public $business;

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

        list(, $this->userid) = Auth::get_user_id();
        $this->template->set_global('uid', $this->userid, false);

        $this->uname = Auth::get_screen_name();
        $this->template->set_global('uname', $this->uname, false);

        $this->ugroup = Auth::get_groups();
        $this->template->set_global('ugroup', $this->ugroup[0][1], false);

        $this->business = Model_Business::find('first');
        //is_null($business) and Response::redirect('business/create'); // should go to installer/setup
        $this->template->set_global('business', $this->business, false);

        $menus = Model_Menu::menu_list_items($this->ugroup[0][1], $this->business);
        $this->template->set_global('menu_list', $menus, false);

    }

}

/* End of file login.php */
