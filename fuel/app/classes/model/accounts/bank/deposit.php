<?php
use Orm\Model_Soft;

class Model_Accounts_Bank_Deposit extends Model_Soft
{
	protected static $_properties = array(
		'id',
		'reference',
		'date',
		'payer',
		'gl_account_id',
		'amount',
		'tax_id',
		'bank_account_id',
		'description',
		'fdesk_user',
		'created_at',
		'updated_at',
		'deleted_at'
	);

	protected static $_soft_delete = array(
	//'deleted_field' => 'deleted',
	'mysql_timestamp' => true,
	);

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
		$val->add_field('reference', 'Reference', 'required|max_length[20]');
		$val->add_field('date', 'Date', 'required');
		$val->add_field('payer', 'Payer', 'required|max_length[50]');
		$val->add_field('amount', 'Amount', 'required');
		$val->add_field('gl_account_id', 'GL Account', 'valid_string[numeric]');
		$val->add_field('tax_id', 'Tax Id', 'valid_string[numeric]');
		$val->add_field('bank_account_id', 'Bank Account', 'required|valid_string[numeric]');
		$val->add_field('description', 'Description', 'required|max_length[255]');

		return $val;
	}

	protected static $_table_name = 'bank_deposit';

	protected static $_belongs_to = array(
		'bank_account' => array(
			'key_from' => 'bank_account_id',
			'model_to' => 'Model_Accounts_Bank_Account',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);
}
