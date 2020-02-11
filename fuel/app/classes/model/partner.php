<?php
use Orm\Model;

class Model_Partner extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'type',
		'inactive',
		'credit_limit',
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
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('type', 'Type', 'required|max_length[255]');
		$val->add_field('inactive', 'Inactive', 'required');
		$val->add_field('credit_limit', 'Credit Limit', 'required');

		return $val;
	}

}
