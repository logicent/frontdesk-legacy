<?php
use Orm\Model;

class Model_Accounts_Tax extends Model
{
	const TAX_TYPE_FIXED = 'Fixed';
	const TAX_TYPE_NORMAL = 'Normal';
	const TAX_TYPE_INCLUSIVE = 'Inclusive';
	const TAX_TYPE_COMPOUND = 'Compound';

	protected static $_properties = array(
        'id',
        'code',
        'name',
        'type',
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

	public static function listOptionsTaxType()
	{
		return array(
			self::TAX_TYPE_FIXED => self::TAX_TYPE_FIXED,
			self::TAX_TYPE_NORMAL => self::TAX_TYPE_NORMAL,
			self::TAX_TYPE_INCLUSIVE => self::TAX_TYPE_INCLUSIVE,
			self::TAX_TYPE_COMPOUND => self::TAX_TYPE_COMPOUND,
		);
	}
}
