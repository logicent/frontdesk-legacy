<?php
class Controller_Facility_Amenity extends Controller_Authenticate
{

	public function action_index()
	{
		$data['amenities'] = Model_Facility_Amenity::find('all');
		$this->template->title = "Amenities";
		$this->template->content = View::forge('facility/amenity/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facilities/amenities');

		if ( ! $data['amenity'] = Model_Facility_Amenity::find($id))
		{
			Session::set_flash('error', 'Could not find amenity #'.$id);
			Response::redirect('facilities/amenities');
		}

		$this->template->title = "Amenity";
		$this->template->content = View::forge('facility/amenity/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Facility_Amenity::validate('create');

			if ($val->run())
			{
				$amenity = Model_Facility_Amenity::forge(array(
					'code' => Input::post('code'),
                    'name' => Input::post('name'),
					'enabled' => Input::post('enabled'),
					// 'is_billable' => Input::post('is_billable'),
					// 'is_metered' => Input::post('is_metered'),
					// 'is_default' => Input::post('is_default'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($amenity and $amenity->save())
				{
					Session::set_flash('success', 'Added amenity #'.$amenity->code.'.');

					Response::redirect('facilities/amenities');
				}

				else
				{
					Session::set_flash('error', 'Could not save amenity.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Amenities";
		$this->template->content = View::forge('facility/amenity/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facilities/amenities');

		if ( ! $amenity = Model_Facility_Amenity::find($id))
		{
			Session::set_flash('error', 'Could not find amenity #'.$id);
			Response::redirect('facilities/amenities');
		}

		$val = Model_Facility_Amenity::validate('edit');

		if ($val->run())
		{
            $amenity->code = Input::post('code');
            $amenity->name = Input::post('name');
            $amenity->enabled = Input::post('enabled');
            $amenity->fdesk_user = Input::post('fdesk_user');
            // $amenity->is_billable = Input::post('is_billable');
            // $amenity->is_metered = Input::post('is_metered');
            // $amenity->is_default = Input::post('is_default');

			if ($amenity->save())
			{
				Session::set_flash('success', 'Updated amenity #' . $amenity->code);

				Response::redirect('facilities/amenities');
			}

			else
			{
				Session::set_flash('error', 'Could not update amenity #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$amenity->code = $val->validated('code');
                $amenity->name = $val->validated('name');
                $amenity->enabled = $val->validated('enabled');
                $amenity->fdesk_user = $val->validated('fdesk_user');
                // $amenity->is_billable = $val->validated('is_billable');
                // $amenity->is_metered = $val->validated('is_metered');
                // $amenity->is_default = $val->validated('is_default');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('amenity', $amenity, false);
		}

		$this->template->title = "Amenities";
		$this->template->content = View::forge('facility/amenity/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facilities/amenities');

		if ($amenity = Model_Facility_Amenity::find($id))
		{
			$amenity->delete();

			Session::set_flash('success', 'Deleted amenity #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete amenity #'.$id);
		}

		Response::redirect('facilities/amenities');

	}

}
