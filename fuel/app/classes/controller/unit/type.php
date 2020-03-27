<?php

class Controller_Unit_Type extends Controller_Authenticate
{
	public function action_index()
	{
		$data['unit_type'] = Model_Unit_Type::find('all');
		$this->template->title = "Unit Type";
		$this->template->content = View::forge('unit/type/index', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Unit_Type::validate('create');

			if ($val->run())
			{
				$unit_type = Model_Unit_Type::forge(array(
                    'code' => Input::post('code'),
					'name' => Input::post('name'),
                    'description' => Input::post('description'),
                    'alias' => Input::post('alias'),
                    'base_rate' => Input::post('base_rate'),
                    'property_id' => Input::post('property_id'),
                    'used_for' => Input::post('used_for'),
                    'inactive' => Input::post('inactive'),
                    'ota_mappings' => Input::post('ota_mappings'),
                    'amenities' => Input::post('amenities'),
                    // 'image_path' => Input::post('image_path'),
                    'fdesk_user' => Input::post('fdesk_user'),
                    'max_persons' => Input::post('max_persons'),
                    'default_pax' => Input::post('default_pax'),
				));

                // upload and save the file
				$file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $unit_type->image_path = 'uploads'.DS.$file['name'];

				if ($unit_type and $unit_type->save())
				{
					Session::set_flash('success', 'Added unit type #'.$unit_type->name.'.');

					Response::redirect('facilities/unit-type');
				}

				else
				{
					Session::set_flash('error', 'Could not save unit type.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Unit Type";
		$this->template->content = View::forge('unit/type/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facilities/unit-type');

		if ( ! $unit_type = Model_Unit_Type::find($id))
		{
			Session::set_flash('error', 'Could not find unit type #'.$id);
			Response::redirect('facilities/unit-type');
		}

		$val = Model_Unit_Type::validate('edit');

		if ($val->run())
		{
            $unit_type->code = Input::post('code');
			$unit_type->name = Input::post('name');
			$unit_type->description = Input::post('description');
            $unit_type->alias = Input::post('alias');
            $unit_type->base_rate = Input::post('base_rate');
            $unit_type->used_for = Input::post('used_for');
            $unit_type->property_id = Input::post('property_id');
            $unit_type->inactive = Input::post('inactive');
            $unit_type->ota_mappings = Input::post('ota_mappings');
            $unit_type->amenities = Input::post('amenities');
            // $unit_type->image_path = Input::post('image_path');
            $unit_type->fdesk_user = Input::post('fdesk_user');
            $unit_type->max_persons = Input::post('max_persons');
            $unit_type->default_pax = Input::post('default_pax');

            // upload and save the file
            $file = Filehelper::upload();

            if (!empty($file['saved_as']))
                $unit_type->image_path = 'uploads'.DS.$file['name'];

			if ($unit_type->save())
			{
				Session::set_flash('success', 'Updated unit type #' . $unit_type->name);

				Response::redirect('facilities/unit-type');
			}

			else
			{
				Session::set_flash('error', 'Could not update unit type #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
                // upload and save the file
                $file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $unit_type->image_path = 'uploads'.DS.$file['name'];
                else 
                    $unit_type->image_path = $val->validated('image_path');

                $unit_type->code = $val->validated('code');
				$unit_type->name = $val->validated('name');
				$unit_type->description = $val->validated('description');
                $unit_type->alias = $val->validated('alias');
                $unit_type->base_rate = $val->validated('base_rate');
                $unit_type->used_for = $val->validated('used_for');
                $unit_type->property_id = $val->validated('property_id');
                $unit_type->inactive = $val->validated('inactive');
                $unit_type->ota_mappings = $val->validated('ota_mappings');
                $unit_type->amenities = $val->validated('amenities');
                $unit_type->image_path = $val->validated('image_path');
                $unit_type->fdesk_user = $val->validated('fdesk_user');
                $unit_type->max_persons = $val->validated('max_persons');
                $unit_type->default_pax = $val->validated('default_pax');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('unit_type', $unit_type, false);
		}

		$this->template->title = "Unit Type";
		$this->template->content = View::forge('unit/type/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facilities/unit-type');

        if (Input::method() == 'POST')
		{		
			if ($unit_type = Model_Unit_Type::find($id))
			{
				$unit = Model_Unit::find('first', array('where' => array('unit_type' => $id)));
				if ($unit)
					Session::set_flash('error', 'Unit type is already in use by Unit(s).');
				else
				{
					$unit_type->delete();
					Session::set_flash('success', 'Deleted unit type #'.$id);
				}
			}
			else
			{
				Session::set_flash('error', 'Could not delete unit type #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}
		
		Response::redirect('facilities/unit-type');

	}

    public function action_remove_img($id)
	{
		$unit_type = Model_Unit_Type::find($id);
		if (!$unit_type) {
			Session::set_flash('error', 'Unit type not found.');
			Response::redirect('facilities/unit-type');
		}
        // unlink file
        try 
        {
            File::delete(DOCROOT . $unit_type->image_path);
        }
        catch (Exception $e)
        {
            Session::set_flash('error', $e->getMessage());
    		Response::redirect('unit/type/edit/' . $unit_type->id);
        }

		// remove image path
		$unit_type->image_path = '';
		if ($unit_type->save()) {
			Session::set_flash('success', 'Saved unit type info.');
		}
		Response::redirect('unit/type/edit/' . $unit_type->id);
	}
}
