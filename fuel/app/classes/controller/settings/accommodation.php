<?php

class Controller_Settings_Accommodation extends Controller_Authenticate
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Settings Accommodation';
		$this->template->content = View::forge('settings/accommodation/index', $data);
	}

}
