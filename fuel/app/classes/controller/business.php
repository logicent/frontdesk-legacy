<?php

class Controller_Business extends Controller_Authenticate
{
	public function action_index()
	{
		$business = Model_Business::find('first');
		is_null($business) and Response::redirect('business/create');

		$val = Model_Business::validate('edit');

		if ($val->run())
		{
			$business->business_name = Input::post('business_name');
			$business->trading_name = Input::post('trading_name');
			$business->address = Input::post('address');
			$business->tax_identifier = Input::post('tax_identifier');
			$business->business_type = Input::post('business_type');
			$business->currency_symbol = Input::post('currency_symbol');
			$business->email_address = Input::post('email_address');
			$business->phone_number = Input::post('phone_number');

			if ( $this->ugroup == 6)
			{
				$business->service_accommodation = Input::post('service_accommodation');
				$business->service_rental = Input::post('service_rental');
				$business->service_hire = Input::post('service_hire');
				$business->service_sale = Input::post('service_sale');
			}

			try {
				// upload and save the file
				$file = Filehelper::upload();

                if (!empty($file['saved_as']))
				    $business->business_logo = 'uploads'.DS.$file['name'];

				if ($business->save())
				{
					Session::set_flash('success', 'Updated business information.');
					Response::redirect('business/view');
				}
				else
				{
					Session::set_flash('error', 'Could not update business information.');
				}
			}
	        catch (Fuel\Upload\NoFilesException $e) {
	            Session::set_flash('error', $e->getMessage());
	        }
			catch (DomainException $e) {
				Session::set_flash('error', $e->getMessage());
			}
			catch (Fuel\Core\PhpErrorException $e) {
				Session::set_flash('error', $e->getMessage());
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				// upload and save the file
				$file = Filehelper::upload();

                if (!empty($file['saved_as']))
				    $business->business_logo = 'uploads'.DS.$file['name'];
                else 
                    $business->business_logo = $val->validated('business_logo');

				$business->business_name = $val->validated('business_name');
				$business->trading_name = $val->validated('trading_name');
				$business->address = $val->validated('address');
				$business->tax_identifier = $val->validated('tax_identifier');
				$business->business_type = $val->validated('business_type');
				$business->currency_symbol = $val->validated('currency_symbol');
				$business->email_address = $val->validated('email_address');
				$business->phone_number = $val->validated('phone_number');

				if ( $this->ugroup == 6)
				{
					$business->service_accommodation = $val->validated('service_accommodation');
					$business->service_rental = $val->validated('service_rental');
					$business->service_hire = $val->validated('service_hire');
					$business->service_sale = $val->validated('service_sale');
				}
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('business', $business, false);
		}
		$this->template->title = "Business";
		$this->template->content = View::forge('business/index');
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('settings/business-detail');

		if ( ! $data['business'] = Model_Business::find($id))
		{
			Session::set_flash('error', 'Could not find business #'.$id);
			Response::redirect('business');
		}

		$this->template->title = "Business";
		$this->template->content = View::forge('business/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Business::validate('create');

			if ($val->run())
			{                                    
				$business = Model_Business::forge(array(
					'business_name' => Input::post('business_name'),
					'trading_name' => Input::post('trading_name'),
					'address' => Input::post('address'),
					'tax_identifier' => Input::post('tax_identifier'),
					'business_type' => Input::post('business_type'),
					'currency_symbol' => Input::post('currency_symbol'),
                    'email_address' => Input::post('email_address'),
                    'phone_number' => Input::post('phone_number'),
					'service_accommodation' => Input::post('service_accommodation'),
					'service_rental' => Input::post('service_rental'),
					'service_hire' => Input::post('service_hire'),
					'service_sale' => Input::post('service_sale'),
				));
                // upload and save the file
				$file = Filehelper::upload();

                if (!empty($file['saved_as']))
                    $business->business_logo = 'uploads'.DS.$file['name'];

				if ($business and $business->save())
				{
					Session::set_flash('success', 'Saved business information.');
					Response::redirect('business');
				}
				else
				{
					Session::set_flash('error', 'Could not save business information.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->title = "Business";
		$this->template->content = View::forge('business/index');
	}

	public function action_remove_img($id)
	{
		$business = Model_Business::find($id);
		if (!$business) {
			Session::set_flash('error', 'Business record not found.');
			Response::redirect('business');
		}
		// unlink file
		File::delete(DOCROOT . $business->business_logo);
		// remove image path
		$business->business_logo = '';
		if ($business->save()) {
			Session::set_flash('success', 'Saved business information.');
		}
		Response::redirect('business');
	}
}
