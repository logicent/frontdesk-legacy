<?php
use Orm\Model;

class Model_Gift_Voucher extends Model
{
	protected static $_properties = array(
		'id',
		'code',
		'name',
		'type',
		'valid_from',
		'valid_to',
		'value',
		'is_redeemed',
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
		$val->add_field('type', 'Type', 'required|max_length[255]');
		$val->add_field('valid_from', 'Valid From', 'required');
		$val->add_field('valid_to', 'Valid To', 'required');
		$val->add_field('value', 'Value', 'required');
		$val->add_field('is_redeemed', 'Is Redeemed', 'required');

		return $val;
	}

}
