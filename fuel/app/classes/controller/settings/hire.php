<?php

class Controller_Settings_Hire extends Controller_Authenticate
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Settings Hire';
		$this->template->content = View::forge('settings/hire/index', $data);
	}

}
