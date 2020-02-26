<?php
class Controller_Summary extends Controller_Authenticate{

	public function action_index()
	{
		$data['summaries'] = Model_Summary::find('all');
		$this->template->title = "Summaries";
		$this->template->content = View::forge('summary/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('summary');

		if ( ! $data['summary'] = Model_Summary::find($id))
		{
			Session::set_flash('error', 'Could not find summary #'.$id);
			Response::redirect('summary');
		}

		$this->template->title = "Summary";
		$this->template->content = View::forge('summary/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Summary::validate('create');
			
			if ($val->run())
			{
				$summary = Model_Summary::forge(array(
					'reference' => Input::post('reference'),
					'date' => Input::post('date'),
					'rooms_sold' => Input::post('rooms_sold'),
					'rooms_blocked' => Input::post('rooms_blocked'),
					'complimentary_rooms' => Input::post('complimentary_rooms'),
					'no_of_guests' => Input::post('no_of_guests'),
					'opening_bal' => Input::post('opening_bal'),
					'rent_total' => Input::post('rent_total'),
					'discount_total' => Input::post('discount_total'),
					'settlement_total' => Input::post('settlement_total'),
					'expense_total' => Input::post('expense_total'),
					'deposits_total' => Input::post('deposits_total'),
					'closing_bal' => Input::post('closing_bal'),
					'fdesk_user' => Input::post('fdesk_user'),
				));

				if ($summary and $summary->save())
				{
					Session::set_flash('success', 'Added summary #'.$summary->id.'.');

					Response::redirect('summary');
				}

				else
				{
					Session::set_flash('error', 'Could not save summary.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Summaries";
		$this->template->content = View::forge('summary/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('summary');

		if ( ! $summary = Model_Summary::find($id))
		{
			Session::set_flash('error', 'Could not find summary #'.$id);
			Response::redirect('summary');
		}

		$val = Model_Summary::validate('edit');

		if ($val->run())
		{
			$summary->reference = Input::post('reference');
			$summary->date = Input::post('date');
			$summary->rooms_sold = Input::post('rooms_sold');
			$summary->rooms_blocked = Input::post('rooms_blocked');
			$summary->complimentary_rooms = Input::post('complimentary_rooms');
			$summary->no_of_guests = Input::post('no_of_guests');
			$summary->opening_bal = Input::post('opening_bal');
			$summary->rent_total = Input::post('rent_total');
			$summary->discount_total = Input::post('discount_total');
			$summary->settlement_total = Input::post('settlement_total');
			$summary->expense_total = Input::post('expense_total');
			$summary->deposits_total = Input::post('deposits_total');
			$summary->closing_bal = Input::post('closing_bal');
			$summary->fdesk_user = Input::post('fdesk_user');

			if ($summary->save())
			{
				Session::set_flash('success', 'Updated summary #' . $id);

				Response::redirect('summary');
			}

			else
			{
				Session::set_flash('error', 'Could not update summary #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$summary->reference = $val->validated('reference');
				$summary->date = $val->validated('date');
				$summary->rooms_sold = $val->validated('rooms_sold');
				$summary->rooms_blocked = $val->validated('rooms_blocked');
				$summary->complimentary_rooms = $val->validated('complimentary_rooms');
				$summary->no_of_guests = $val->validated('no_of_guests');
				$summary->opening_bal = $val->validated('opening_bal');
				$summary->rent_total = $val->validated('rent_total');
				$summary->discount_total = $val->validated('discount_total');
				$summary->settlement_total = $val->validated('settlement_total');
				$summary->expense_total = $val->validated('expense_total');
				$summary->deposits_total = $val->validated('deposits_total');
				$summary->closing_bal = $val->validated('closing_bal');
				$summary->fdesk_user = $val->validated('fdesk_user');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('summary', $summary, false);
		}

		$this->template->title = "Summaries";
		$this->template->content = View::forge('summary/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('summary');

		if ($summary = Model_Summary::find($id))
		{
			$summary->delete();

			Session::set_flash('success', 'Deleted summary #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete summary #'.$id);
		}

		Response::redirect('summary');

	}


}
