<?php
class Controller_Purchase_Payment extends Controller_Template
{

	public function action_index()
	{
		$data['purchase_payments'] = Model_Purchase_Payment::find('all');
		$this->template->title = "Purchase_payments";
		$this->template->content = View::forge('purchase/payment/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('purchase/payment');

		if ( ! $data['purchase_payment'] = Model_Purchase_Payment::find($id))
		{
			Session::set_flash('error', 'Could not find purchase_payment #'.$id);
			Response::redirect('purchase/payment');
		}

		$this->template->title = "Purchase_payment";
		$this->template->content = View::forge('purchase/payment/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Purchase_Payment::validate('create');

			if ($val->run())
			{
				$purchase_payment = Model_Purchase_Payment::forge(array(
				));

				if ($purchase_payment and $purchase_payment->save())
				{
					Session::set_flash('success', 'Added purchase_payment #'.$purchase_payment->id.'.');

					Response::redirect('purchase/payment');
				}

				else
				{
					Session::set_flash('error', 'Could not save purchase_payment.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Purchase_Payments";
		$this->template->content = View::forge('purchase/payment/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('purchase/payment');

		if ( ! $purchase_payment = Model_Purchase_Payment::find($id))
		{
			Session::set_flash('error', 'Could not find purchase_payment #'.$id);
			Response::redirect('purchase/payment');
		}

		$val = Model_Purchase_Payment::validate('edit');

		if ($val->run())
		{

			if ($purchase_payment->save())
			{
				Session::set_flash('success', 'Updated purchase_payment #' . $id);

				Response::redirect('purchase/payment');
			}

			else
			{
				Session::set_flash('error', 'Could not update purchase_payment #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('purchase_payment', $purchase_payment, false);
		}

		$this->template->title = "Purchase_payments";
		$this->template->content = View::forge('purchase/payment/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('purchase/payment');

		if ($purchase_payment = Model_Purchase_Payment::find($id))
		{
			$purchase_payment->delete();

			Session::set_flash('success', 'Deleted purchase_payment #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete purchase_payment #'.$id);
		}

		Response::redirect('purchase/payment');

	}

}
