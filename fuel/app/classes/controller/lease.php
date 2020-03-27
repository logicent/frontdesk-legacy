<?php
class Controller_Lease extends Controller_Authenticate
{

	public function action_index()
	{
		$data['leases'] = Model_Lease::find('all');
		$this->template->title = "Leases";
		$this->template->content = View::forge('lease/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('registers/lease');

		if ( ! $data['lease'] = Model_Lease::find($id))
		{
			Session::set_flash('error', 'Could not find lease #'.$id);
			Response::redirect('registers/lease');
		}

		$this->template->title = "Lease";
		$this->template->content = View::forge('lease/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Lease::validate('create');

			if ($val->run())
			{
				$lease = Model_Lease::forge(array(
					'reference' => Input::post('reference'),
					'title' => Input::post('title'),
					'customer_id' => Input::post('customer_id'),
					'status' => Input::post('status'),
					'date_leased' => Input::post('date_leased'),
					'premise_use' => Input::post('premise_use'),
					'lease_period' => Input::post('lease_period'),
					'billed_period' => Input::post('billed_period'),
					'billed_amount' => Input::post('billed_amount'),
					'require_deposit' => Input::post('require_deposit'),
					'deposit_amount' => Input::post('deposit_amount'),
					'deposit_includes' => Input::post('deposit_includes'),
					'start_date' => Input::post('start_date'),
					'end_date' => Input::post('end_date'),
					'owner_id' => Input::post('owner_id'),
					'property_id' => Input::post('property_id'),
					'unit_id' => Input::post('unit_id'),
					'on_hold' => Input::post('on_hold'),
					'on_hold_from' => Input::post('on_hold_from'),
					'on_hold_to' => Input::post('on_hold_to'),
                    'remarks' => Input::post('remarks'),
                    'fdesk_user' => Input::post('fdesk_user'),
				));

                // upload and save the file
				$file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $lease->attachments = 'uploads'.DS.$file['name'];

				try {
					if ($lease and $lease->save())
					{
						Session::set_flash('success', 'Added lease #'.$lease->title.'.');

						Response::redirect('registers/lease');
					}

					else
					{
						Session::set_flash('error', 'Could not save lease.');
					}
				}
				catch (Fuel\Core\Database_Exception $e)
				{
					Session::set_flash('error', $e->getMessage());
					// throw $e;
				}				
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Leases";
		$this->template->content = View::forge('lease/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('registers/lease');

		if ( ! $lease = Model_Lease::find($id))
		{
			Session::set_flash('error', 'Could not find lease #'.$id);
			Response::redirect('registers/lease');
		}

		$val = Model_Lease::validate('edit');

		if ($val->run())
		{
			$lease->reference = Input::post('reference');
			$lease->title = Input::post('title');
			$lease->customer_id = Input::post('customer_id');
			$lease->status = Input::post('status');
			$lease->date_leased = Input::post('date_leased');
			$lease->premise_use = Input::post('premise_use');
			$lease->lease_period = Input::post('lease_period');
			$lease->billed_period = Input::post('billed_period');
			$lease->billed_amount = Input::post('billed_amount');
			$lease->require_deposit = Input::post('require_deposit');
			$lease->deposit_amount = Input::post('deposit_amount');
			$lease->deposit_includes = Input::post('deposit_includes');
			$lease->start_date = Input::post('start_date');
			$lease->end_date = Input::post('end_date');
			$lease->owner_id = Input::post('owner_id');
			$lease->property_id = Input::post('property_id');
			$lease->unit_id = Input::post('unit_id');
			$lease->on_hold = Input::post('on_hold');
			$lease->on_hold_from = Input::post('on_hold_from');
			$lease->on_hold_to = Input::post('on_hold_to');
            $lease->remarks = Input::post('remarks');
            $lease->fdesk_user = Input::post('fdesk_user');

            // upload and save the file
            $file = Filehelper::upload();

            if (!empty($file['saved_as']))
                $lease->attachments = 'uploads'.DS.$file['name'];
	 
			try {
				if ($lease->save())
				{
					Session::set_flash('success', 'Updated lease #' . $lease->title);

					Response::redirect('registers/lease');
				}
				else
				{
					Session::set_flash('error', 'Could not update lease #' . $id);
				}
			}
			catch (Fuel\Core\Database_Exception $e)
			{
				Session::set_flash('error', $e->getMessage());
				// throw $e;
			}			
		}

		else
		{
			if (Input::method() == 'POST')
			{
                // upload and save the file
                $file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $lease->attachments = 'uploads'.DS.$file['name'];
                else 
                    $lease->attachments = $val->validated('attachments');

				$lease->reference = $val->validated('reference');
				$lease->title = $val->validated('title');
				$lease->customer_id = $val->validated('customer_id');
				$lease->status = $val->validated('status');
				$lease->date_leased = $val->validated('date_leased');
				$lease->premise_use = $val->validated('premise_use');
				$lease->lease_period = $val->validated('lease_period');
				$lease->billed_period = $val->validated('billed_period');
				$lease->billed_amount = $val->validated('billed_amount');
				$lease->require_deposit = $val->validated('require_deposit');
				$lease->deposit_amount = $val->validated('deposit_amount');
				$lease->deposit_includes = $val->validated('deposit_includes');
				$lease->start_date = $val->validated('start_date');
				$lease->end_date = $val->validated('end_date');
				$lease->owner_id = $val->validated('owner_id');
				$lease->property_id = $val->validated('property_id');
				$lease->unit_id = $val->validated('unit_id');
				$lease->on_hold = $val->validated('on_hold');
				$lease->on_hold_from = $val->validated('on_hold_from');
				$lease->on_hold_to = $val->validated('on_hold_to');
				$lease->remarks = $val->validated('remarks');
                $lease->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('lease', $lease, false);
		}

		$this->template->title = "Leases";
		$this->template->content = View::forge('lease/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('registers/lease');

		if (Input::method() == 'POST')
		{
			if ($lease = Model_Lease::find($id))
			{
				$lease->delete();

				Session::set_flash('success', 'Deleted lease #'.$id);
			}

			else
			{
				Session::set_flash('error', 'Could not delete lease #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}
		
		Response::redirect('registers/lease');

	}

    public function action_get_owner_list_options()
	{
        $listOptions = [];
        
        if (Input::is_ajax());
            $listOptions = Model_Property::listOptionsPropertyOwner(Input::post('property'));
        
        return json_encode($listOptions);
	}

    public function action_get_property_list_options()
	{
        $listOptions = [];
        
        if (Input::is_ajax());
            $listOptions = Model_Property::listOptionsProperty(Input::post('owner'));
        
        return json_encode($listOptions);
	}

    public function action_get_unit_list_options()
	{
        $listOptions = [];
        
        if (Input::is_ajax());
        {
            $units = Model_Unit::query()
                                ->select(
                                    array('id', 'name')
                                )
                                ->related(
                                        'type', array(
                                            'where' => array('property_id' => Input::post('property')),
                                        ),
                                )
                                ->get();
            if ($units)
                foreach ($units as $unit)
                    $listOptions[$unit->id] = $unit->name;
        }

        return json_encode($listOptions);
	}

}
