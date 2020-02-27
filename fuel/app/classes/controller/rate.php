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
                    // 'amount' => Input::post('amount'),
                    'charges' => Input::post('charges'),
                    'billing_period' => Input::post('billing_period'),
                    // 'applicable_tax' => Input::post('applicable_tax'),
                    // 'channels' => Input::post('channels'),
                    'is_tax_incl' => Input::post('is_tax_incl'),
                    'enabled' => Input::post('enabled'),
                    // 'rate_group' => Input::post('rate_group'),
                    'valid_from' => Input::post('valid_from'),
                    'valid_until' => Input::post('valid_until'),
                    'fdesk_user' => Input::post('fdesk_user'),
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
            // $rate->amount = Input::post('amount');
            $rate->charges = Input::post('charges');
            $rate->billing_period = Input::post('billing_period');
            // $rate->applicable_tax = Input::post('applicable_tax');
            // $rate->channels = Input::post('channels');
            $rate->is_tax_incl = Input::post('is_tax_incl');
            $rate->enabled = Input::post('enabled');
            // $rate->rate_group = Input::post('rate_group');
            $rate->valid_from = Input::post('valid_from');
            $rate->valid_until = Input::post('valid_until');
            $rate->fdesk_user = Input::post('fdesk_user');

			if ($rate->save())
			{
				Session::set_flash('success', 'Updated room rate #' . $rate->description);

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
                // $rate->amount = $val->validated('amount');
                $rate->charges = $val->validated('charges');
                $rate->billing_period = $val->validated('billing_period');
                // $rate->applicable_tax = $val->validated('applicable_tax');
                // $rate->channels = $val->validated('channels');
                $rate->is_tax_incl = $val->validated('is_tax_incl');
                $rate->enabled = $val->validated('enabled');
                // $rate->rate_group = $val->validated('rate_group');
                $rate->valid_from = $val->validated('valid_from');
                $rate->valid_until = $val->validated('valid_until');
                $rate->fdesk_user = $val->validated('fdesk_user');

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
