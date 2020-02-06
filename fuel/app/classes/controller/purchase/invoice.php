<?php
class Controller_Purchase_Invoice extends Controller_Template
{

	public function action_index()
	{
		$data['purchase_invoices'] = Model_Purchase_Invoice::find('all');
		$this->template->title = "Purchase_invoices";
		$this->template->content = View::forge('purchase/invoice/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('purchase/invoice');

		if ( ! $data['purchase_invoice'] = Model_Purchase_Invoice::find($id))
		{
			Session::set_flash('error', 'Could not find purchase_invoice #'.$id);
			Response::redirect('purchase/invoice');
		}

		$this->template->title = "Purchase_invoice";
		$this->template->content = View::forge('purchase/invoice/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Purchase_Invoice::validate('create');

			if ($val->run())
			{
				$purchase_invoice = Model_Purchase_Invoice::forge(array(
				));

				if ($purchase_invoice and $purchase_invoice->save())
				{
					Session::set_flash('success', 'Added purchase_invoice #'.$purchase_invoice->id.'.');

					Response::redirect('purchase/invoice');
				}

				else
				{
					Session::set_flash('error', 'Could not save purchase_invoice.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Purchase_Invoices";
		$this->template->content = View::forge('purchase/invoice/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('purchase/invoice');

		if ( ! $purchase_invoice = Model_Purchase_Invoice::find($id))
		{
			Session::set_flash('error', 'Could not find purchase_invoice #'.$id);
			Response::redirect('purchase/invoice');
		}

		$val = Model_Purchase_Invoice::validate('edit');

		if ($val->run())
		{

			if ($purchase_invoice->save())
			{
				Session::set_flash('success', 'Updated purchase_invoice #' . $id);

				Response::redirect('purchase/invoice');
			}

			else
			{
				Session::set_flash('error', 'Could not update purchase_invoice #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('purchase_invoice', $purchase_invoice, false);
		}

		$this->template->title = "Purchase_invoices";
		$this->template->content = View::forge('purchase/invoice/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('purchase/invoice');

		if ($purchase_invoice = Model_Purchase_Invoice::find($id))
		{
			$purchase_invoice->delete();

			Session::set_flash('success', 'Deleted purchase_invoice #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete purchase_invoice #'.$id);
		}

		Response::redirect('purchase/invoice');

	}

}
