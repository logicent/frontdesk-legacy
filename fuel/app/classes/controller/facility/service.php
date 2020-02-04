<?php
class Controller_Facility_Service extends Controller_Authenticate
{

	public function action_index()
	{
		$data['services'] = Model_Facility_Service::find('all');
		$this->template->title = "Services";
		$this->template->content = View::forge('facility/service/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facility/service');

		if ( ! $data['service'] = Model_Facility_Service::find($id))
		{
			Session::set_flash('error', 'Could not find service #'.$id);
			Response::redirect('facility/service');
		}

		$this->template->title = "Service";
		$this->template->content = View::forge('facility/service/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Facility_Service::validate('create');

			if ($val->run())
			{
				$service = Model_Facility_Service::forge(array(
				));

				if ($service and $service->save())
				{
					Session::set_flash('success', 'Added service #'.$service->id.'.');

					Response::redirect('facility/service');
				}

				else
				{
					Session::set_flash('error', 'Could not save service.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Services";
		$this->template->content = View::forge('facility/service/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facility/service');

		if ( ! $service = Model_Facility_Service::find($id))
		{
			Session::set_flash('error', 'Could not find service #'.$id);
			Response::redirect('facility/service');
		}

		$val = Model_Facility_Service::validate('edit');

		if ($val->run())
		{

			if ($service->save())
			{
				Session::set_flash('success', 'Updated service #' . $id);

				Response::redirect('facility/service');
			}

			else
			{
				Session::set_flash('error', 'Could not update service #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('service', $service, false);
		}

		$this->template->title = "Services";
		$this->template->content = View::forge('facility/service/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facility/service');

		if ($service = Model_Facility_Service::find($id))
		{
			$service->delete();

			Session::set_flash('success', 'Deleted service #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete service #'.$id);
		}

		Response::redirect('facility/service');

	}

}
