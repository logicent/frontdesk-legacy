<?php
class Controller_Sales_Quotation extends Controller_Template
{

	public function action_index()
	{
		$data['sales_quotations'] = Model_Sales_Quotation::find('all');
		$this->template->title = "Sales_quotations";
		$this->template->content = View::forge('sales/quotation/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('sales/quotation');

		if ( ! $data['sales_quotation'] = Model_Sales_Quotation::find($id))
		{
			Session::set_flash('error', 'Could not find sales_quotation #'.$id);
			Response::redirect('sales/quotation');
		}

		$this->template->title = "Sales_quotation";
		$this->template->content = View::forge('sales/quotation/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Sales_Quotation::validate('create');

			if ($val->run())
			{
				$sales_quotation = Model_Sales_Quotation::forge(array(
				));

				if ($sales_quotation and $sales_quotation->save())
				{
					Session::set_flash('success', 'Added sales_quotation #'.$sales_quotation->id.'.');

					Response::redirect('sales/quotation');
				}

				else
				{
					Session::set_flash('error', 'Could not save sales_quotation.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Sales_Quotations";
		$this->template->content = View::forge('sales/quotation/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('sales/quotation');

		if ( ! $sales_quotation = Model_Sales_Quotation::find($id))
		{
			Session::set_flash('error', 'Could not find sales_quotation #'.$id);
			Response::redirect('sales/quotation');
		}

		$val = Model_Sales_Quotation::validate('edit');

		if ($val->run())
		{

			if ($sales_quotation->save())
			{
				Session::set_flash('success', 'Updated sales_quotation #' . $id);

				Response::redirect('sales/quotation');
			}

			else
			{
				Session::set_flash('error', 'Could not update sales_quotation #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sales_quotation', $sales_quotation, false);
		}

		$this->template->title = "Sales_quotations";
		$this->template->content = View::forge('sales/quotation/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('sales/quotation');

		if ($sales_quotation = Model_Sales_Quotation::find($id))
		{
			$sales_quotation->delete();

			Session::set_flash('success', 'Deleted sales_quotation #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete sales_quotation #'.$id);
		}

		Response::redirect('sales/quotation');

	}

}
