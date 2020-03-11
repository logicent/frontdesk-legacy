<?php

class Controller_Dashboard extends Controller_Authenticate{

	public function action_index()
	{
		// check if business info is defined
		$business = Model_Business::find('first');
		if (!$business) {
			Session::set_flash('warning', 'Add your business information to complete setup.');
			Response::redirect('business/create');
		}

        $unit_types = Model_Unit_Type::find('all', 
											array(
												'related' => array(
													'units', 
													'rates'
												),
												'where' => array('inactive' => false), 
											)
										);
        
		$unit_type_has_undefined_rate = false;
		
		foreach ($unit_types as $unit_type) 
		{
            $unit_type_has_undefined_rate = count($unit_type->rates) == 0;
            if ($unit_type_has_undefined_rate) {
                Session::set_flash('warning', "Add facilities rate for {$unit_type->name}");
                Response::redirect('facilities/rates');
            }
        }
        
		$rates = Model_Rate::find('first');
		if (!$rates) {
			Session::set_flash('warning', 'Add your facilities rates to enable bookings and leasing.');
			Response::redirect('facilities/rates');
		}

		$data = array();
		
		// get accommodation units stats
		$data['accommodation'] = Model_Dashboard::get_accommodation_stats();

		// get rental units stats
		$data['rental'] = Model_Dashboard::get_rental_stats();

		// get hire units stats
		$data['hire'] = Model_Dashboard::get_hire_stats();

		$this->template->title = "Dashboard";
		$this->template->content = View::forge('dashboard', $data);

	}

}
