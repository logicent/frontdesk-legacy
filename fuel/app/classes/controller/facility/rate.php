<?php
class Controller_Facility_Rate extends Controller_Authenticate
{

	public function action_index()
	{
		$data['rates'] = Model_Facility_Rate::find('all');
		$this->template->title = "Rates";
		$this->template->content = View::forge('facility/rate/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('facility/rate');

		if ( ! $data['rate'] = Model_Facility_Rate::find($id))
		{
			Session::set_flash('error', 'Could not find rate #'.$id);
			Response::redirect('facility/rate');
		}

		$this->template->title = "Rate";
		$this->template->content = View::forge('facility/rate/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Facility_Rate::validate('create');

			if ($val->run())
			{
				$rate = Model_Facility_Rate::forge(array(
				));

				if ($rate and $rate->save())
				{
					Session::set_flash('success', 'Added rate #'.$rate->id.'.');

					Response::redirect('facility/rate');
				}

				else
				{
					Session::set_flash('error', 'Could not save rate.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Rates";
		$this->template->content = View::forge('facility/rate/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('facility/rate');

		if ( ! $rate = Model_Facility_Rate::find($id))
		{
			Session::set_flash('error', 'Could not find rate #'.$id);
			Response::redirect('facility/rate');
		}

		$val = Model_Facility_Rate::validate('edit');

		if ($val->run())
		{

			if ($rate->save())
			{
				Session::set_flash('success', 'Updated rate #' . $id);

				Response::redirect('facility/rate');
			}

			else
			{
				Session::set_flash('error', 'Could not update rate #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('rate', $rate, false);
		}

		$this->template->title = "Rates";
		$this->template->content = View::forge('facility/rate/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('facility/rate');

		if ($rate = Model_Facility_Rate::find($id))
		{
			$rate->delete();

			Session::set_flash('success', 'Deleted rate #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete rate #'.$id);
		}

		Response::redirect('facility/rate');

	}

}
