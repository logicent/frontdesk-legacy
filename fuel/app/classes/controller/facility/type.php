<?php
class Controller_Facility_Type extends Controller_Authenticate
{

	public function action_index()
	{
		$data['types'] = Model_Facility_Type::find('all');
		$this->template->title = "Types";
		$this->template->content = View::forge('facility/type/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facility/type');

		if ( ! $data['type'] = Model_Facility_Type::find($id))
		{
			Session::set_flash('error', 'Could not find type #'.$id);
			Response::redirect('facility/type');
		}

		$this->template->title = "Type";
		$this->template->content = View::forge('facility/type/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Facility_Type::validate('create');

			if ($val->run())
			{
				$type = Model_Facility_Type::forge(array(
				));

				if ($type and $type->save())
				{
					Session::set_flash('success', 'Added type #'.$type->id.'.');

					Response::redirect('facility/type');
				}

				else
				{
					Session::set_flash('error', 'Could not save type.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Types";
		$this->template->content = View::forge('facility/type/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facility/type');

		if ( ! $type = Model_Facility_Type::find($id))
		{
			Session::set_flash('error', 'Could not find type #'.$id);
			Response::redirect('facility/type');
		}

		$val = Model_Facility_Type::validate('edit');

		if ($val->run())
		{

			if ($type->save())
			{
				Session::set_flash('success', 'Updated type #' . $id);

				Response::redirect('facility/type');
			}

			else
			{
				Session::set_flash('error', 'Could not update type #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('type', $type, false);
		}

		$this->template->title = "Types";
		$this->template->content = View::forge('facility/type/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facility/type');

		if ($type = Model_Facility_Type::find($id))
		{
			$type->delete();

			Session::set_flash('success', 'Deleted type #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete type #'.$id);
		}

		Response::redirect('facility/type');

	}

}
