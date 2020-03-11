<?php
use Orm\Model;

class Model_Hr_Attendance extends Model
{
	protected static $_properties = array(
		'id',
		'employee_id',
		'work_day',
		'status',
		'fdesk_user',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('employee_id', 'Employee Id', 'required|valid_string[numeric]');
		$val->add_field('work_day', 'Work Day', 'required');
		$val->add_field('status', 'Status', 'required|max_length[255]');
		$val->add_field('fdesk_user', 'Fdesk User', 'required|valid_string[numeric]');

		return $val;
	}

}
