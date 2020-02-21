<?php
class Controller_Property extends Controller_Authenticate
{

	public function action_index()
	{
		$data['properties'] = Model_Property::find('all');
		$this->template->title = "Property";
		$this->template->content = View::forge('property/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facilities/property');

		if ( ! $data['property'] = Model_Property::find($id))
		{
			Session::set_flash('error', 'Could not find property #'.$id);
			Response::redirect('facilities/property');
		}

		$this->template->title = "Property";
		$this->template->content = View::forge('property/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Property::validate('create');

			if ($val->run())
			{
				$property = Model_Property::forge(array(
					'code' => Input::post('code'),
                    'name' => Input::post('name'),
                    'fdesk_user' => Input::post('fdesk_user'),
					'description' => Input::post('description'),
					'physical_address' => Input::post('physical_address'),
					'map_location' => Input::post('map_location'),
					'property_type' => Input::post('property_type'),
					'owner' => Input::post('owner'),
					'property_ref' => Input::post('property_ref'),
					'date_signed' => Input::post('date_signed'),
					'date_released' => Input::post('date_released'),
					'inactive' => Input::post('inactive'),
					'on_hold' => Input::post('on_hold'),
					'on_hold_from' => Input::post('on_hold_from'),
					'on_hold_to' => Input::post('on_hold_to'),
					'remarks' => Input::post('remarks'),
				));

				if ($property and $property->save())
				{
					Session::set_flash('success', 'Added property #'.$property->name.'.');

					Response::redirect('facilities/property');
				}

				else
				{
					Session::set_flash('error', 'Could not save property.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Property";
		$this->template->content = View::forge('property/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facilities/property');

		if ( ! $property = Model_Property::find($id))
		{
			Session::set_flash('error', 'Could not find property #'.$id);
			Response::redirect('facilities/property');
		}

		$val = Model_Property::validate('edit');

		if ($val->run())
		{
			$property->code = Input::post('code');
            $property->name = Input::post('name');
            $property->fdesk_user = Input::post('fdesk_user');
            $property->description = Input::post('description');
            $property->physical_address = Input::post('physical_address');
			$property->map_location = Input::post('map_location');
			$property->property_type = Input::post('property_type');
			$property->owner = Input::post('owner');
			$property->property_ref = Input::post('property_ref');
			$property->date_signed = Input::post('date_signed');
			$property->date_released = Input::post('date_released');
			$property->inactive = Input::post('inactive');
			$property->on_hold = Input::post('on_hold');
			$property->on_hold_from = Input::post('on_hold_from');
			$property->on_hold_to = Input::post('on_hold_to');
			$property->remarks = Input::post('remarks');

			if ($property->save())
			{
				Session::set_flash('success', 'Updated property #' . $property->name);

				Response::redirect('facilities/property');
			}

			else
			{
				Session::set_flash('error', 'Could not update property #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$property->code = $val->validated('code');
                $property->name = $val->validated('name');
                $property->fdesk_user = $val->validated('fdesk_user');
                $property->description = $val->validated('description');
                $property->physical_address = $val->validated('physical_address');
				$property->map_location = $val->validated('map_location');
				$property->property_type = $val->validated('property_type');
				$property->owner = $val->validated('owner');
				$property->property_ref = $val->validated('property_ref');
				$property->date_signed = $val->validated('date_signed');
				$property->date_released = $val->validated('date_released');
				$property->inactive = $val->validated('inactive');
				$property->on_hold = $val->validated('on_hold');
				$property->on_hold_from = $val->validated('on_hold_from');
				$property->on_hold_to = $val->validated('on_hold_to');
				$property->remarks = $val->validated('remarks');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('property', $property, false);
		}

		$this->template->title = "Property";
		$this->template->content = View::forge('property/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facilities/property');

		if ($property = Model_Property::find($id))
		{
			$property->delete();

			Session::set_flash('success', 'Deleted property #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete property #'.$id);
		}

		Response::redirect('facilities/property');

	}

}
