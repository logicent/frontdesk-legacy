<?php

class Controller_Settings_Rental extends Controller_Authenticate
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Settings Rental';
		$this->template->content = View::forge('settings/rental/index', $data);
	}

}
