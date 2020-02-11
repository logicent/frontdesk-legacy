<?php

class Controller_Reports extends Controller_Authenticate
{
	public function action_index()
	{
		$data['reports'] = Model_Report_Builder::find('all', array('where' => array('published' => true)));

		$this->template->title = 'Reports';
		$this->template->content = View::forge('reports/index', $data);
	}

	public function action_show_daily()
	{
		$slug = Input::post('rpt_name');
		$date = Input::post('rpt_date');
		$data['report'] = Model_Report_Builder::find('first', array('where' => array('slug' => $slug)));
		$data['report']->date_of = date("dS M, Y", strtotime($date));

		$data = array_merge($data, Model_Report_Creator::generate($slug, $date));

		$view = View::forge('template_print');
		$view->title = $data['report']->name . ' Report';

		switch ($slug)
		{
			case 'daily-summary':
				$data['row_results'] = Model_Report_Creator::generateSummary($date);
				$view->content = View::forge('reports/period_summary', $data);
				break;
			// case 'room-availability':
			// 	$view->content = View::forge('reports/room_availability', $data);
			// 	break;
			default: // daily-expense, checkin-out etc
				$view->content = View::forge('reports/view', $data);
		}

		return new Response($view);
	}

	public function action_show_monthly()
	{
		$slug = Input::post('rpt_name');
		$date = Input::post('rpt_period');
		$data['report'] = Model_Report_Builder::find('first', array('where' => array('slug' => $slug)));
		$data['report']->date_of = $date;
		$data = array_merge($data, Model_Report_Creator::generateMonthly($slug, $date), array('date' => $date));

		$view = View::forge('template_print');
		$view->title = $data['report']->name . ' Report';

		switch ($slug)
		{
			case 'monthly-summary':
				$data['row_results'] = Model_Report_Creator::generateSummary($date, 'M');
				$view->content = View::forge('reports/period_summary', $data);
				break;
			// case 'room-availability':
			// 	$view->content = View::forge('reports/room_availability', $data);
			// 	break;
			default:
				$view->content = View::forge('reports/view', $data);
		}

		return new Response($view);
	}
}
