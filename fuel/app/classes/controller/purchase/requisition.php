<?php
class Controller_Purchase_Requisition extends Controller_Template
{

	public function action_index()
	{
		$data['purchase_requisitions'] = Model_Purchase_Requisition::find('all');
		$this->template->title = "Purchase_requisitions";
		$this->template->content = View::forge('purchase/requisition/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('purchase/requisition');

		if ( ! $data['purchase_requisition'] = Model_Purchase_Requisition::find($id))
		{
			Session::set_flash('error', 'Could not find purchase_requisition #'.$id);
			Response::redirect('purchase/requisition');
		}

		$this->template->title = "Purchase_requisition";
		$this->template->content = View::forge('purchase/requisition/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Purchase_Requisition::validate('create');

			if ($val->run())
			{
				$purchase_requisition = Model_Purchase_Requisition::forge(array(
				));

				if ($purchase_requisition and $purchase_requisition->save())
				{
					Session::set_flash('success', 'Added purchase_requisition #'.$purchase_requisition->id.'.');

					Response::redirect('purchase/requisition');
				}

				else
				{
					Session::set_flash('error', 'Could not save purchase_requisition.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Purchase_Requisitions";
		$this->template->content = View::forge('purchase/requisition/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('purchase/requisition');

		if ( ! $purchase_requisition = Model_Purchase_Requisition::find($id))
		{
			Session::set_flash('error', 'Could not find purchase_requisition #'.$id);
			Response::redirect('purchase/requisition');
		}

		$val = Model_Purchase_Requisition::validate('edit');

		if ($val->run())
		{

			if ($purchase_requisition->save())
			{
				Session::set_flash('success', 'Updated purchase_requisition #' . $id);

				Response::redirect('purchase/requisition');
			}

			else
			{
				Session::set_flash('error', 'Could not update purchase_requisition #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('purchase_requisition', $purchase_requisition, false);
		}

		$this->template->title = "Purchase_requisitions";
		$this->template->content = View::forge('purchase/requisition/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('purchase/requisition');

		if ($purchase_requisition = Model_Purchase_Requisition::find($id))
		{
			$purchase_requisition->delete();

			Session::set_flash('success', 'Deleted purchase_requisition #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete purchase_requisition #'.$id);
		}

		Response::redirect('purchase/requisition');

	}

}
