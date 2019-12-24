<?php
class Controller_Rate extends Controller_Authenticate{

	public function action_index()
	{
		$data['rate'] = Model_Rate::find('all');
		$this->template->title = "Rate";
		$this->template->content = View::forge('rate/index', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Rate::validate('create');

			if ($val->run())
			{
				$rate = Model_Rate::forge(array(
					'rate_id' => Input::post('rate_id'),
					'type_id' => Input::post('type_id'),
					'description' => Input::post('description'),
					'charges' => Input::post('charges'),
				));

				if ($rate and $rate->save())
				{
					Session::set_flash('success', 'Added room rate #'.$rate->room_type->name.' - '.$rate->rate_type->name);

					Response::redirect('rate');
				}

				else
				{
					Session::set_flash('error', 'Could not save room rate.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Rate";
		$this->template->content = View::forge('rate/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('rate');

		if ( ! $rate = Model_Rate::find($id))
		{
			Session::set_flash('error', 'Could not find rate #'.$id);
			Response::redirect('rate');
		}

		$val = Model_Rate::validate('edit');

		if ($val->run())
		{
			$rate->rate_id = Input::post('rate_id');
			$rate->type_id = Input::post('type_id');
			$rate->description = Input::post('description');
			$rate->charges = Input::post('charges');

			if ($rate->save())
			{
				Session::set_flash('success', 'Updated room rate #' . $id);

				Response::redirect('rate');
			}

			else
			{
				Session::set_flash('error', 'Could not update room rate #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$rate->rate_id = $val->validated('rate_id');
				$rate->type_id = $val->validated('type_id');
				$rate->description = $val->validated('description');
				$rate->charges = $val->validated('charges');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('rate', $rate, false);
		}

		$this->template->title = "Rate";
		$this->template->content = View::forge('rate/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('rate');

		if ($rate = Model_Rate::find($id))
		{
			$rate->delete();

			Session::set_flash('success', 'Deleted room rate #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete room rate #'.$id);
		}

		Response::redirect('rate');
	}

}
