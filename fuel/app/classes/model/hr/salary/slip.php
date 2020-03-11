<?php
use Orm\Model;

class Model_Hr_Salary_Slip extends Model
{
	protected static $_properties = array(
		'id',
		'code',
		'name',
		'employee_id',
		'designation',
		'start_date',
		'end_date',
		'status',
		'date_posted',
		'date_due',
		'payroll_period',
		'total_deductions',
		'total_earnings',
		'total_gross',
		'net_amount',
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
		$val->add_field('code', 'Code', 'required|max_length[255]');
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('employee_id', 'Employee Id', 'required|valid_string[numeric]');
		$val->add_field('designation', 'Designation', 'required|max_length[255]');
		$val->add_field('start_date', 'Start Date', 'required');
		$val->add_field('end_date', 'End Date', 'required');
		$val->add_field('status', 'Status', 'required|max_length[255]');
		$val->add_field('date_posted', 'Date Posted', 'required');
		$val->add_field('date_due', 'Date Due', 'required');
		$val->add_field('payroll_period', 'Payroll Period', 'required|max_length[255]');
		$val->add_field('total_deductions', 'Total Deductions', 'required');
		$val->add_field('total_earnings', 'Total Earnings', 'required');
		$val->add_field('total_gross', 'Total Gross', 'required');
		$val->add_field('net_amount', 'Net Amount', 'required');
		$val->add_field('fdesk_user', 'Fdesk User', 'required|valid_string[numeric]');

		return $val;
	}

}
