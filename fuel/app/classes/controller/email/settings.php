<?php

class Controller_Email_Settings extends Controller_Authenticate
{

	public function action_index()
	{
		$data['email_settings'] = Model_Email_Setting::find('all');
		$this->template->title = "Email Settings";
		$this->template->content = View::forge('email/settings/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('email/settings');

		if ( ! $data['email_setting'] = Model_Email_Setting::find($id))
		{
			Session::set_flash('error', 'Could not find email settings #'.$id);
			Response::redirect('email/settings');
		}

		$this->template->title = "Email_setting";
		$this->template->content = View::forge('email/settings/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Email_Setting::validate('create');

			if ($val->run())
			{
				$email_setting = Model_Email_Setting::forge(array(
					'from_address' => Input::post('from_address'),
					'from_name' => Input::post('from_name'),
					'smtp_host' => Input::post('smtp_host'),
					'smtp_username' => Input::post('smtp_username'),
					'smtp_password' => Input::post('smtp_password'),
					'smtp_port' => Input::post('smtp_port'),
					'smtp_starttls' => Input::post('smtp_starttls'),
					'smtp_timeout' => Input::post('smtp_timeout'),
				));

				if ($email_setting and $email_setting->save())
				{
					Session::set_flash('success', 'Added email settings #'.$email_setting->smtp_host.'.');

					Response::redirect('settings/email-settings');
				}

				else
				{
					Session::set_flash('error', 'Could not save email_setting.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Email Settings";
		$this->template->content = View::forge('email/settings/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('email/settings');

		if ( ! $email_setting = Model_Email_Setting::find($id))
		{
			Session::set_flash('error', 'Could not find email settings #'.$id);
			Response::redirect('email/settings');
		}

		$val = Model_Email_Setting::validate('edit');

		if ($val->run())
		{
			$email_setting->from_address = Input::post('from_address');
			$email_setting->from_name = Input::post('from_name');
			$email_setting->smtp_host = Input::post('smtp_host');
			$email_setting->smtp_username = Input::post('smtp_username');
			$email_setting->smtp_password = Input::post('smtp_password');
			$email_setting->smtp_port = Input::post('smtp_port');
			$email_setting->smtp_starttls = Input::post('smtp_starttls');
			$email_setting->smtp_timeout = Input::post('smtp_timeout');

			if ($email_setting->save())
			{
				Session::set_flash('success', 'Updated email settings #' . $email_setting->smtp_host);

				Response::redirect('settings/email-settings');
			}

			else
			{
				Session::set_flash('error', 'Could not update email settings #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

                $email_setting->from_address = $val->validated('from_address');
                $email_setting->from_name = $val->validated('from_name');
				$email_setting->smtp_host = $val->validated('smtp_host');
				$email_setting->smtp_username = $val->validated('smtp_username');
				$email_setting->smtp_password = $val->validated('smtp_password');
				$email_setting->smtp_port = $val->validated('smtp_port');
				$email_setting->smtp_starttls = $val->validated('smtp_starttls');
				$email_setting->smtp_timeout = $val->validated('smtp_timeout');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('email_setting', $email_setting, false);
		}

		$this->template->title = "Email settings";
		$this->template->content = View::forge('email/settings/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('email/settings');

		if ($email_setting = Model_Email_Setting::find($id))
		{
			$email_setting->delete();

			Session::set_flash('success', 'Deleted email settings #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete email setting #'.$id);
		}

		Response::redirect('settings/email-settings');

	}

}
