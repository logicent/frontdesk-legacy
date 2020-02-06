<?php
class Controller_Folios extends Controller_Template
{

	public function action_index()
	{
		$data['folios'] = Model_Folio::find('all');
		$this->template->title = "Folios";
		$this->template->content = View::forge('folios/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('folios');

		if ( ! $data['folio'] = Model_Folio::find($id))
		{
			Session::set_flash('error', 'Could not find folio #'.$id);
			Response::redirect('folios');
		}

		$this->template->title = "Folio";
		$this->template->content = View::forge('folios/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Folio::validate('create');

			if ($val->run())
			{
				$folio = Model_Folio::forge(array(
				));

				if ($folio and $folio->save())
				{
					Session::set_flash('success', 'Added folio #'.$folio->id.'.');

					Response::redirect('folios');
				}

				else
				{
					Session::set_flash('error', 'Could not save folio.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Folios";
		$this->template->content = View::forge('folios/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('folios');

		if ( ! $folio = Model_Folio::find($id))
		{
			Session::set_flash('error', 'Could not find folio #'.$id);
			Response::redirect('folios');
		}

		$val = Model_Folio::validate('edit');

		if ($val->run())
		{

			if ($folio->save())
			{
				Session::set_flash('success', 'Updated folio #' . $id);

				Response::redirect('folios');
			}

			else
			{
				Session::set_flash('error', 'Could not update folio #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('folio', $folio, false);
		}

		$this->template->title = "Folios";
		$this->template->content = View::forge('folios/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('folios');

		if ($folio = Model_Folio::find($id))
		{
			$folio->delete();

			Session::set_flash('success', 'Deleted folio #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete folio #'.$id);
		}

		Response::redirect('folios');

	}

}
