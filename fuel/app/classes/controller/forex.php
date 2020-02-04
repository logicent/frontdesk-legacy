<?php

class Controller_Forex extends Controller_Authenticate
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Forex &raquo; Index';
		$this->template->content = View::forge('forex/index', $data);
	}

}
