<?php
use Orm\Model_Soft;

class Model_Expense_Claim extends Model_Soft
{
	protected static $_properties = array(
		'id',
		'credit_account_id',
		'reference',
		'date',
		'payer',
		'payee',
		'gl_account_id',
		'amount',
		'tax_id',
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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('credit_account_id', 'Credit Account', 'valid_string[numeric]');
		$val->add_field('reference', 'Reference', 'required|valid_string[numeric]');
		$val->add_field('date', 'Date', 'required|valid_date');
		$val->add_field('payer', 'Payer', 'max_length[255]');
		$val->add_field('payee', 'Payee', 'required|max_length[255]');
		$val->add_field('gl_account_id', 'GL Account', 'valid_string[numeric]');
		$val->add_field('amount', 'Amount', 'required');
		$val->add_field('tax_id', 'Vat', 'valid_string[numeric]');
		$val->add_field('description', 'Description', 'max_length[255]');

		return $val;
	}

	protected static $_table_name = 'expense_claim';
}
