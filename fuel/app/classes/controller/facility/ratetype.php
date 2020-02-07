<?php
class Controller_Facility_Ratetype extends Controller_Authenticate
{

	public function action_index()
	{
		$data['ratetypes'] = Model_Facility_Ratetype::find('all');
		$this->template->title = "Ratetypes";
		$this->template->content = View::forge('facility/ratetype/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facility/ratetype');

		if ( ! $data['ratetype'] = Model_Facility_Ratetype::find($id))
		{
			Session::set_flash('error', 'Could not find ratetype #'.$id);
			Response::redirect('facility/ratetype');
		}

		$this->template->title = "Ratetype";
		$this->template->content = View::forge('facility/ratetype/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Facility_Ratetype::validate('create');

			if ($val->run())
			{
				$ratetype = Model_Facility_Ratetype::forge(array(
				));

				if ($ratetype and $ratetype->save())
				{
					Session::set_flash('success', 'Added ratetype #'.$ratetype->id.'.');

					Response::redirect('facility/ratetype');
				}

				else
				{
					Session::set_flash('error', 'Could not save ratetype.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Ratetypes";
		$this->template->content = View::forge('facility/ratetype/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facility/ratetype');

		if ( ! $ratetype = Model_Facility_Ratetype::find($id))
		{
			Session::set_flash('error', 'Could not find ratetype #'.$id);
			Response::redirect('facility/ratetype');
		}

		$val = Model_Facility_Ratetype::validate('edit');

		if ($val->run())
		{

			if ($ratetype->save())
			{
				Session::set_flash('success', 'Updated ratetype #' . $id);

				Response::redirect('facility/ratetype');
			}

			else
			{
				Session::set_flash('error', 'Could not update ratetype #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('ratetype', $ratetype, false);
		}

		$this->template->title = "Ratetypes";
		$this->template->content = View::forge('facility/ratetype/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facility/ratetype');

		if ($ratetype = Model_Facility_Ratetype::find($id))
		{
			$ratetype->delete();

			Session::set_flash('success', 'Deleted ratetype #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete ratetype #'.$id);
		}

		Response::redirect('facility/ratetype');

	}

}
