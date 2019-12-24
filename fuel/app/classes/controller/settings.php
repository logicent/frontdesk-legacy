<?php

class Controller_Settings extends Controller_Authenticate
{

	public function action_index()
	{
		// settings LP
		$this->template->title = 'Settings';
		$this->template->content = View::forge('settings/index');
	}

}
