<?php
use Orm\Model;

class Model_Accounts_Tax extends Model
{
	protected static $_properties = array(
        'id',
        'code',
        'name',
        'rate',
        'enabled',
        'fdesk_user',
		'created_at',
		'updated_at',
	);

	protected static $_table_name = 'taxes';

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('code', 'Code', 'required|valid_string');
        $val->add_field('name', 'Description', 'required');
        $val->add_field('rate', 'Tax rate', 'required|valid_string[numeric]');
        // $val->add_field('enabled', 'Apply tax', 'boolean');

		return $val;
	}

}
