<?php
use Orm\Model;

class Model_Hr_Employment_Type extends Model
{
	protected static $_properties = array(
		'id',
		'code',
		'description',
		'enabled',
		'fdesk_user',
		'created_at',
		'updated_at',
	);

	protected static $_table_name = 'employment_type';

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
		$val->add_field('description', 'Description', 'required|max_length[255]');
		$val->add_field('enabled', 'Enabled', 'required');
		$val->add_field('fdesk_user', 'Fdesk User', 'required|valid_string[numeric]');

		return $val;
	}

}
