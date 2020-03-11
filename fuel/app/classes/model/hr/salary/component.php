<?php
use Orm\Model;

class Model_Hr_Salary_Component extends Model
{
	protected static $_properties = array(
		'id',
		'code',
		'name',
		'description',
		'enabled',
		'is_payable',
		'is_tax_applicable',
		'depends_on_payment_days',
		'type',
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
		$val->add_field('description', 'Description', 'required|max_length[255]');
		$val->add_field('enabled', 'Enabled', 'required');
		$val->add_field('is_payable', 'Is Payable', 'required');
		$val->add_field('is_tax_applicable', 'Is Tax Applicable', 'required');
		$val->add_field('depends_on_payment_days', 'Depends On Payment Days', 'required');
		$val->add_field('type', 'Type', 'required|max_length[255]');
		$val->add_field('fdesk_user', 'Fdesk User', 'required|valid_string[numeric]');

		return $val;
	}

}
