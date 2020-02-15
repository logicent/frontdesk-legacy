<?php

class Controller_Facility_Stayover extends Controller_Authenticate
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Facility/stayover &raquo; Index';
		$this->template->content = View::forge('facility/stayover/index', $data);
	}

}
