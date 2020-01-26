<?php

class Controller_Help extends Controller_Authenticate
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Help &raquo; Index';
		$this->template->content = View::forge('help/index', $data);
	}

}
