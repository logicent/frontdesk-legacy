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
			$service_type->name = Input::post('name');
			$service_type->code = Input::post('code');
			$service_type->enabled = Input::post('enabled');
            $service_type->fdesk_user = Input::post('fdesk_user');

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
				$service_type->name = $val->validated('name');
				$service_type->code = $val->validated('code');
				$service_type->enabled = $val->validated('enabled');
                $service_type->fdesk_user = $val->validated('fdesk_user');

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

		if ($property_type = Model_Property_Type::find($id))
		{
			$property_type->delete();

			Session::set_flash('success', 'Deleted property type #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete property type #'.$id);
		}

		Response::redirect('facilities/property-type');

	}

}
