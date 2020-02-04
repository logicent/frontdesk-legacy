<?php
class Controller_Task_Checklist extends Controller_Template
{

	public function action_index()
	{
		$data['checklists'] = Model_Task_Checklist::find('all');
		$this->template->title = "Checklists";
		$this->template->content = View::forge('task/checklist/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('task/checklist');

		if ( ! $data['checklist'] = Model_Task_Checklist::find($id))
		{
			Session::set_flash('error', 'Could not find checklist #'.$id);
			Response::redirect('task/checklist');
		}

		$this->template->title = "Checklist";
		$this->template->content = View::forge('task/checklist/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Task_Checklist::validate('create');

			if ($val->run())
			{
				$checklist = Model_Task_Checklist::forge(array(
				));

				if ($checklist and $checklist->save())
				{
					Session::set_flash('success', 'Added checklist #'.$checklist->id.'.');

					Response::redirect('task/checklist');
				}

				else
				{
					Session::set_flash('error', 'Could not save checklist.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Checklists";
		$this->template->content = View::forge('task/checklist/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('task/checklist');

		if ( ! $checklist = Model_Task_Checklist::find($id))
		{
			Session::set_flash('error', 'Could not find checklist #'.$id);
			Response::redirect('task/checklist');
		}

		$val = Model_Task_Checklist::validate('edit');

		if ($val->run())
		{

			if ($checklist->save())
			{
				Session::set_flash('success', 'Updated checklist #' . $id);

				Response::redirect('task/checklist');
			}

			else
			{
				Session::set_flash('error', 'Could not update checklist #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('checklist', $checklist, false);
		}

		$this->template->title = "Checklists";
		$this->template->content = View::forge('task/checklist/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('task/checklist');

		if ($checklist = Model_Task_Checklist::find($id))
		{
			$checklist->delete();

			Session::set_flash('success', 'Deleted checklist #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete checklist #'.$id);
		}

		Response::redirect('task/checklist');

	}

}
