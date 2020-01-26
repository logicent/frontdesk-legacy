<?php

class Controller_Report_Period extends Controller_Authenticate
{
	public function action_index()
	{
		$data['report_period'] = Model_Report_Period::find('all');
		$this->template->title = "Report_period";
		$this->template->content = View::forge('report/period/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('report/period');

		if ( ! $data['report_period'] = Model_Report_Period::find($id))
		{
			Session::set_flash('error', 'Could not find report_period #'.$id);
			Response::redirect('report/period');
		}

		$this->template->title = "Report_period";
		$this->template->content = View::forge('report/period/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Report_Period::validate('create');

			if ($val->run())
			{
				$report_period = Model_Report_Period::forge(array(
					'from_date' => Input::post('from_date'),
					'to_date' => Input::post('to_date'),
					'acctg_method' => Input::post('acctg_method'),
					'description' => Input::post('description'),
					'report_type' => Input::post('report_type'),
				));

				if ($report_period and $report_period->save())
				{
					Session::set_flash('success', 'Added report_period #'.$report_period->id.'.');

					Response::redirect('report/period');
				}

				else
				{
					Session::set_flash('error', 'Could not save report_period.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Report_Period";
		$this->template->content = View::forge('report/period/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('report/period');

		if ( ! $report_period = Model_Report_Period::find($id))
		{
			Session::set_flash('error', 'Could not find report_period #'.$id);
			Response::redirect('report/period');
		}

		$val = Model_Report_Period::validate('edit');

		if ($val->run())
		{
			$report_period->from_date = Input::post('from_date');
			$report_period->to_date = Input::post('to_date');
			$report_period->acctg_method = Input::post('acctg_method');
			$report_period->description = Input::post('description');
			$report_period->report_type = Input::post('report_type');

			if ($report_period->save())
			{
				Session::set_flash('success', 'Updated report_period #' . $id);

				Response::redirect('report/period');
			}

			else
			{
				Session::set_flash('error', 'Could not update report_period #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$report_period->from_date = $val->validated('from_date');
				$report_period->to_date = $val->validated('to_date');
				$report_period->acctg_method = $val->validated('acctg_method');
				$report_period->description = $val->validated('description');
				$report_period->report_type = $val->validated('report_type');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('report_period', $report_period, false);
		}

		$this->template->title = "Report_period";
		$this->template->content = View::forge('report/period/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('report/period');

		if ($report_period = Model_Report_Period::find($id))
		{
			$report_period->delete();

			Session::set_flash('success', 'Deleted report_period #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete report_period #'.$id);
		}

		Response::redirect('report/period');

	}


}
