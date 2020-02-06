<?php
use Orm\Model;

class Model_Accounts_Tax extends Model
{
	protected static $_properties = array(
        'id',
        'tax_rate',
        'tax_identifier',
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
		$val->add_field('code', 'Code', 'valid_string');
        $val->add_field('tax_identifier', 'Tax identifier', 'required');
        $val->add_field('tax_rate', 'Tax rate', 'required');

		return $val;
	}

}
