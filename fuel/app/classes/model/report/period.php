<?php
use Orm\Model;

class Model_Report_Period extends Model
{
	protected static $_properties = array(
		'id',
		'from_date',
		'to_date',
		'acctg_method',
		'description',
		'report_type',
	);


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('from_date', 'From Date', 'required');
		$val->add_field('to_date', 'To Date', 'required');
		$val->add_field('acctg_method', 'Acctg Method', 'required|max_length[1]');
		$val->add_field('description', 'Description', 'required|max_length[255]');
		$val->add_field('report_type', 'Report Type', 'required|max_length[3]');

		return $val;
	}

	protected static $_table_name = 'report';
}
