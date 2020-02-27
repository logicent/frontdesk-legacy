<?php
class Controller_Service_Type extends Controller_Authenticate
{

	public function action_index()
	{
		$data['service_types'] = Model_Service_Type::find('all');
		$this->template->title = "Service_types";
		$this->template->content = View::forge('service/type/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facilities/service-type');

		if ( ! $data['service_type'] = Model_Service_Type::find($id))
		{
			Session::set_flash('error', 'Could not find service type #'.$id);
			Response::redirect('facilities/service-type');
		}

		$this->template->title = "Service_type";
		$this->template->content = View::forge('service/type/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Service_Type::validate('create');

			if ($val->run())
			{
				$service_type = Model_Service_Type::forge(array(
					'name' => Input::post('name'),
					'code' => Input::post('code'),
					'enabled' => Input::post('enabled'),
					'is_default' => Input::post('is_default'),
                    'default_service_provider' => Input::post('default_service_provider'),
                    'fdesk_user' => Input::post('fdesk_user'),
                    
				));

				if ($service_type and $service_type->save())
				{
					Session::set_flash('success', 'Added service type #'.$service_type->code.'.');

					Response::redirect('facilities/service-type');
				}

				else
				{
					Session::set_flash('error', 'Could not save service type.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Service_Types";
		$this->template->content = View::forge('service/type/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facilities/service-type');

		if ( ! $service_type = Model_Service_Type::find($id))
		{
			Session::set_flash('error', 'Could not find service type #'.$id);
			Response::redirect('facilities/service-type');
		}

		$val = Model_Service_Type::validate('edit');

		if ($val->run())
		{
			$service_type->name = Input::post('name');
			$service_type->code = Input::post('code');
			$service_type->enabled = Input::post('enabled');
			$service_type->is_default = Input::post('is_default');
			$service_type->default_service_provider = Input::post('default_service_provider');
            $service_type->fdesk_user = Input::post('fdesk_user');

			if ($service_type->save())
			{
				Session::set_flash('success', 'Updated service type #' . $service_type->code);

				Response::redirect('facilities/service-type');
			}

			else
			{
				Session::set_flash('error', 'Could not update service type #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$service_type->name = $val->validated('name');
				$service_type->code = $val->validated('code');
				$service_type->enabled = $val->validated('enabled');
				$service_type->is_default = $val->validated('is_default');
				$service_type->default_service_provider = $val->validated('default_service_provider');
                $service_type->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('service_type', $service_type, false);
		}

		$this->template->title = "Service_types";
		$this->template->content = View::forge('service/type/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facilities/service-type');

		if ($service_type = Model_Service_Type::find($id))
		{
			$service_type->delete();

			Session::set_flash('success', 'Deleted service type #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete service type #'.$id);
		}

		Response::redirect('facilities/service-type');

	}

}
