<?php
use Orm\Model;

class Model_Report_Builder extends Model
{
	const REPORT_TYPE_HOURLY = 'h';
	const REPORT_TYPE_DAILY = 'd';
	const REPORT_TYPE_WEEKLY = 'w';
	const REPORT_TYPE_MONTHLY = 'm';
	const REPORT_TYPE_QUARTERLY = 'q';
	const REPORT_TYPE_HALFYEAR = 'f';
	const REPORT_TYPE_YEARL = 'y';

	public static $report_type = array(
		self::REPORT_TYPE_DAILY => 'Daily',
		self::REPORT_TYPE_MONTHLY => 'Monthly',
	);

	public $date_of;
	
	protected static $_properties = array(
		'id',
		'name',
		'slug',
		'type',
        'published',
        'db_query',
        'allowed_users',
		'fdesk_user',
		'created_at',
        'updated_at',
        'deleted_at',
	);


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('slug', 'Slug', 'required|max_length[255]');
		$val->add_field('type', 'Type', 'required|max_length[1]');
		$val->add_field('published', 'Published', 'valid_string[numeric]');

		return $val;
	}

	protected static $_table_name = 'report';
}
