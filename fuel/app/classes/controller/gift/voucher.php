<?php
class Controller_Gift_Voucher extends Controller_Authenticate
{

	public function action_index()
	{
		$data['gift_vouchers'] = Model_Gift_Voucher::find('all');
		$this->template->title = "Gift Voucher";
		$this->template->content = View::forge('gift/voucher/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('accounts/gift-voucher');

		if ( ! $data['gift_voucher'] = Model_Gift_Voucher::find($id))
		{
			Session::set_flash('error', 'Could not find gift voucher #'.$id);
			Response::redirect('accounts/gift-voucher');
		}

		$this->template->title = "Gift Voucher";
		$this->template->content = View::forge('gift/voucher/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Gift_Voucher::validate('create');

			if ($val->run())
			{
				$gift_voucher = Model_Gift_Voucher::forge(array(
					'code' => Input::post('code'),
					'name' => Input::post('name'),
					'type' => Input::post('type'),
					'valid_from' => Input::post('valid_from'),
					'valid_to' => Input::post('valid_to'),
					'value' => Input::post('value'),
					'is_redeemed' => Input::post('is_redeemed'),
				));

				if ($gift_voucher and $gift_voucher->save())
				{
					Session::set_flash('success', 'Added gift voucher #'.$gift_voucher->code.'.');

					Response::redirect('accounts/gift-voucher');
				}

				else
				{
					Session::set_flash('error', 'Could not save gift voucher.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Gift Voucher";
		$this->template->content = View::forge('gift/voucher/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('accounts/gift-voucher');

		if ( ! $gift_voucher = Model_Gift_Voucher::find($id))
		{
			Session::set_flash('error', 'Could not find gift voucher #'.$id);
			Response::redirect('accounts/gift-voucher');
		}

		$val = Model_Gift_Voucher::validate('edit');

		if ($val->run())
		{
			$gift_voucher->code = Input::post('code');
			$gift_voucher->name = Input::post('name');
			$gift_voucher->type = Input::post('type');
			$gift_voucher->valid_from = Input::post('valid_from');
			$gift_voucher->valid_to = Input::post('valid_to');
			$gift_voucher->value = Input::post('value');
			$gift_voucher->is_redeemed = Input::post('is_redeemed');

			if ($gift_voucher->save())
			{
				Session::set_flash('success', 'Updated gift voucher #' . $gift_voucher->code);

				Response::redirect('accounts/gift-voucher');
			}

			else
			{
				Session::set_flash('error', 'Could not update gift voucher #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$gift_voucher->code = $val->validated('code');
				$gift_voucher->name = $val->validated('name');
				$gift_voucher->type = $val->validated('type');
				$gift_voucher->valid_from = $val->validated('valid_from');
				$gift_voucher->valid_to = $val->validated('valid_to');
				$gift_voucher->value = $val->validated('value');
				$gift_voucher->is_redeemed = $val->validated('is_redeemed');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('gift_voucher', $gift_voucher, false);
		}

		$this->template->title = "Gift Voucher";
		$this->template->content = View::forge('gift/voucher/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('accounts/gift-voucher');

		if (Input::method() == 'POST')
		{		
			if ($gift_voucher = Model_Gift_Voucher::find($id))
			{
				$gift_voucher->delete();

				Session::set_flash('success', 'Deleted gift voucher #'.$id);
			}
			else
			{
				Session::set_flash('error', 'Could not delete gift voucher #'.$id);
			}
		}
		else
		{
			Session::set_flash('error', 'Delete is not allowed');
		}
		
		Response::redirect('accounts/gift-voucher');

	}

}
