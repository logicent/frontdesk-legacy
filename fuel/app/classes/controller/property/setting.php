<?php
class Controller_Property_Setting extends Controller_Template
{

	public function action_index()
	{
		$data['property_settings'] = Model_Property_Setting::find('all');
		$this->template->title = "Property_settings";
		$this->template->content = View::forge('property/setting/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('property/setting');

		if ( ! $data['property_setting'] = Model_Property_Setting::find($id))
		{
			Session::set_flash('error', 'Could not find property_setting #'.$id);
			Response::redirect('property/setting');
		}

		$this->template->title = "Property_setting";
		$this->template->content = View::forge('property/setting/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Property_Setting::validate('create');

			if ($val->run())
			{
				$property_setting = Model_Property_Setting::forge(array(
					'property_id' => Input::post('property_id'),
					'key' => Input::post('key'),
					'value' => Input::post('value'),
				));

				if ($property_setting and $property_setting->save())
				{
					Session::set_flash('success', 'Added property_setting #'.$property_setting->id.'.');

					Response::redirect('property/setting');
				}

				else
				{
					Session::set_flash('error', 'Could not save property_setting.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Property_Settings";
		$this->template->content = View::forge('property/setting/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('property/setting');

		if ( ! $property_setting = Model_Property_Setting::find($id))
		{
			Session::set_flash('error', 'Could not find property_setting #'.$id);
			Response::redirect('property/setting');
		}

		$val = Model_Property_Setting::validate('edit');

		if ($val->run())
		{
			$property_setting->property_id = Input::post('property_id');
			$property_setting->key = Input::post('key');
			$property_setting->value = Input::post('value');

			if ($property_setting->save())
			{
				Session::set_flash('success', 'Updated property_setting #' . $id);

				Response::redirect('property/setting');
			}

			else
			{
				Session::set_flash('error', 'Could not update property_setting #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$property_setting->property_id = $val->validated('property_id');
				$property_setting->key = $val->validated('key');
				$property_setting->value = $val->validated('value');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('property_setting', $property_setting, false);
		}

		$this->template->title = "Property_settings";
		$this->template->content = View::forge('property/setting/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('property/setting');

		if ($property_setting = Model_Property_Setting::find($id))
		{
			$property_setting->delete();

			Session::set_flash('success', 'Deleted property_setting #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete property_setting #'.$id);
		}

		Response::redirect('property/setting');

	}

}
