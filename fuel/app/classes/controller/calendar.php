<?php

class Controller_Calendar extends Controller_Authenticate
{

	public function action_index($show_del = false)
	{
		if ($show_del)
            $data['events'] = Model_Facility_Booking::deleted('all');
        else
        {
            $status = Input::get('status');
            if (!$status)
                $status = Model_Facility_Booking::GUEST_STATUS_CHECKED_IN;

            $data['events'] = Model_Facility_Booking::find('all', array('where' => array(
                array('status', '=', $status)), 'order_by' => array('reg_no' => 'desc'), 'limit' => 1000));
        }

        $data['status'] = $status;
        
        $data['events'] = $this->prepare_calendar_data($data['events']);
        
		$this->template->title = 'Calendar &raquo; Index';
		$this->template->content = View::forge('calendar/index', $data);
	}

    private function prepare_calendar_data($events)
    {
        $cal_data = [];
        foreach ($events as $key => $event)
        {
            $cal_data[$key]['title'] = $event->first_name . ' ' . $event->last_name;
            $cal_data[$key]['start'] = $event->checkin;
            $cal_data[$key]['end'] = $event->checkout;
        }
        
        return json_encode($cal_data);
    }

	public function action_show_reservations($show_del = false)
	{
		if ($show_del)
			$data['events'] = Model_Fd_Reservation::deleted('all');
		else
		{
			$status = Input::get('status');
			if (!$status)
				$status = Model_Fd_Reservation::RESERVATION_STATUS_OPEN;

			$data['events'] = Model_Fd_Reservation::find('all', array('where' => array(
				array('status', '=', $status)), 'order_by' => array('res_no' => 'desc'), 'limit' => 1000));
		}

		$data['status'] = $status;        
        // return json data of open reservations (current period)
	}

	public function action_show_bookings($show_del = false)
	{
		if ($show_del)
            $data['events'] = Model_Facility_Booking::deleted('all');
        else
        {
            $status = Input::get('status');
            if (!$status)
                $status = Model_Facility_Booking::GUEST_STATUS_CHECKED_IN;

            $data['events'] = Model_Facility_Booking::find('all', array('where' => array(
                array('status', '=', $status)), 'order_by' => array('reg_no' => 'desc'), 'limit' => 1000));
        }

        $data['status'] = $status;
        
        $data['events'] = $this->prepare_calendar_data($data['events']);
        
        return $data['events'];
	}

	public function action_show_all()
	{
        // return json data of all (open/closed) reservations and bokings in period
	}

	public function action_show_both()
	{
        // return json data of open reservations/bookings current period
	}

}
