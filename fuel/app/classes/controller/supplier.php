<?php
class Controller_Supplier extends Controller_Authenticate
{

	public function action_index()
	{
		$data['suppliers'] = Model_Supplier::find('all');
		$this->template->title = "Suppliers";
		$this->template->content = View::forge('supplier/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('supplier');

		if ( ! $data['supplier'] = Model_Supplier::find($id))
		{
			Session::set_flash('error', 'Could not find supplier #'.$id);
			Response::redirect('supplier');
		}

		$this->template->title = "Supplier";
		$this->template->content = View::forge('supplier/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Supplier::validate('create');

			if ($val->run())
			{
				$supplier = Model_Supplier::forge(array(
				));

				if ($supplier and $supplier->save())
				{
					Session::set_flash('success', 'Added supplier #'.$supplier->id.'.');

					Response::redirect('supplier');
				}

				else
				{
					Session::set_flash('error', 'Could not save supplier.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Suppliers";
		$this->template->content = View::forge('supplier/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('supplier');

		if ( ! $supplier = Model_Supplier::find($id))
		{
			Session::set_flash('error', 'Could not find supplier #'.$id);
			Response::redirect('supplier');
		}

		$val = Model_Supplier::validate('edit');

		if ($val->run())
		{

			if ($supplier->save())
			{
				Session::set_flash('success', 'Updated supplier #' . $id);

				Response::redirect('supplier');
			}

			else
			{
				Session::set_flash('error', 'Could not update supplier #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('supplier', $supplier, false);
		}

		$this->template->title = "Suppliers";
		$this->template->content = View::forge('supplier/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('supplier');

		if ($supplier = Model_Supplier::find($id))
		{
			$supplier->delete();

			Session::set_flash('success', 'Deleted supplier #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete supplier #'.$id);
		}

		Response::redirect('supplier');

	}

}
