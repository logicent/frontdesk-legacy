<?php

class Controller_Facility_Nightaudit extends Controller_Authenticate
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Facility/nightaudit &raquo; Index';
		$this->template->content = View::forge('facility/nightaudit/index', $data);
	}

}
