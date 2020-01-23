<?php
use Orm\Model;

class Model_Email_Setting extends Model
{
	protected static $_properties = array(
		'id',
		'from_address',
		'from_name',
		'smtp_host',
		'smtp_username',
		'smtp_password',
		'smtp_port',
		'smtp_starttls',
		'smtp_timeout',
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
		$val->add_field('from_address', 'From Address', 'required|max_length[255]');
		$val->add_field('from_name', 'From Name', 'max_length[255]');
		$val->add_field('smtp_host', 'Smtp Host', 'required|max_length[255]');
		$val->add_field('smtp_username', 'Smtp Username', 'required|max_length[255]');
		$val->add_field('smtp_password', 'Smtp Password', 'required|max_length[255]');
		$val->add_field('smtp_port', 'Smtp Port', 'required|valid_string[numeric]');
		// $val->add_field('smtp_starttls', 'Smtp Starttls', '');
		$val->add_field('smtp_timeout', 'Smtp Timeout', 'valid_string[numeric]');

		return $val;
	}

}
