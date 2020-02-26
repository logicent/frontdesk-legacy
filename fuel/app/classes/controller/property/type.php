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
		is_null($id) and Response::redirect('property/type');

		if ( ! $data['property_type'] = Model_Property_Type::find($id))
		{
			Session::set_flash('error', 'Could not find property_type #'.$id);
			Response::redirect('property/type');
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
				));

				if ($property_type and $property_type->save())
				{
					Session::set_flash('success', 'Added property_type #'.$property_type->id.'.');

					Response::redirect('property/type');
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
		is_null($id) and Response::redirect('property/type');

		if ( ! $property_type = Model_Property_Type::find($id))
		{
			Session::set_flash('error', 'Could not find property_type #'.$id);
			Response::redirect('property/type');
		}

		$val = Model_Property_Type::validate('edit');

		if ($val->run())
		{

			if ($property_type->save())
			{
				Session::set_flash('success', 'Updated property_type #' . $id);

				Response::redirect('property/type');
			}

			else
			{
				Session::set_flash('error', 'Could not update property_type #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('property_type', $property_type, false);
		}

		$this->template->title = "Property_types";
		$this->template->content = View::forge('property/type/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('property/type');

		if ($property_type = Model_Property_Type::find($id))
		{
			$property_type->delete();

			Session::set_flash('success', 'Deleted property_type #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete property_type #'.$id);
		}

		Response::redirect('property/type');

	}

}
