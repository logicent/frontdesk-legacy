<?php

class Controller_Property_Type extends Controller_Authenticate
{
	public function action_index()
	{
		$data['property_types'] = Model_Property_Type::find('all');
		$this->template->title = "Property_types";
		$this->template->content = View::forge('property/type/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facilities/property-type');

		if ( ! $data['property_type'] = Model_Property_Type::find($id))
		{
			Session::set_flash('error', 'Could not find property type #'.$id);
			Response::redirect('facilities/property-type');
		}
		$this->template->title = "Property_type";
		$this->template->content = View::forge('property/type/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Property_Type::validate('create');
			if ($val->run())
			{
				$property_type = Model_Property_Type::forge(array(
					'name' => Input::post('name'),
					'group' => Input::post('group'),
					'code' => Input::post('code'),
					'enabled' => Input::post('enabled'),
                    'fdesk_user' => Input::post('fdesk_user'),                    
				));
				if ($property_type and $property_type->save())
				{
					Session::set_flash('success', 'Added property type #'.$property_type->name.'.');
					Response::redirect('facilities/property-type');
				}
				else
				{
					Session::set_flash('error', 'Could not save property_type.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->title = "Property_Types";
		$this->template->content = View::forge('property/type/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facilities/property-type');

		if ( ! $property_type = Model_Property_Type::find($id))
		{
			Session::set_flash('error', 'Could not find property type #'.$id);
			Response::redirect('facilities/property-type');
		}
		$val = Model_Property_Type::validate('edit');
		if ($val->run())
		{
			$property_type->name = Input::post('name');
			$property_type->group = Input::post('group');
			$property_type->code = Input::post('code');
			$property_type->enabled = Input::post('enabled');
            $property_type->fdesk_user = Input::post('fdesk_user');

			if ($property_type->save())
			{
				Session::set_flash('success', 'Updated property type #' . $property_type->name);
				Response::redirect('facilities/property-type');
			}
			else
			{
				Session::set_flash('error', 'Could not update property type #' . $id);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$property_type->name = $val->validated('name');
				$property_type->group = $val->validated('group');
				$property_type->code = $val->validated('code');
				$property_type->enabled = $val->validated('enabled');
                $property_type->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('property_type', $property_type, false);
		}
		$this->template->title = "Property_types";
		$this->template->content = View::forge('property/type/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facilities/property-type');
		
		if (Input::method() == 'POST')
		{
			if ($property_type = Model_Property_Type::find($id))
			{
				// TODO: check if referenced in property model
				$property = Model_Property::find(array('type' => $id));
				if (!$property)
				{
					$property_type->delete();
					Session::set_flash('success', 'Deleted property type #'.$id);
				}
				else
				{
					Session::set_flash('error', 'Property type has some attached property');
				}
			}
			else
			{
				Session::set_flash('error', 'Could not delete property type #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}
		Response::redirect('facilities/property-type');
	}
}