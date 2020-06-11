<?php
use Orm\Model;

class Model_Accounts_Bank_Account extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'account_number',
		'financial_institution',
		'starting_bal',
		'starting_date',
		'i_banking_na',
		'last_statement_date',
	);

	protected static $_observers = array(
		'Orm\Observer_Typing' => array(
			'events' => array('before_save', 'after_save', 'after_load'),
			// 'null' => true,
		)
	);
	
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[140]');
		$val->add_field('account_number', 'Account Number', 'required|max_length[20]');
		$val->add_field('financial_institution', 'Financial Institution', 'required|max_length[140]');
		// $val->add_field('starting_bal', 'Starting Balance', 'valid_string[numeric]');
		// $val->add_field('starting_date', 'Starting Date', 'valid_date');
		//$val->add_field('i_banking_na', 'I Banking Na', 'required');
		// $val->add_field('last_statement_date', 'Last Statement Date', 'valid_date');

		return $val;
	}

	protected static $_table_name = 'bank_account';

	public static function listOptions()
	{
		$items = DB::select('id','account_number', 'name')->from(self::$_table_name)->execute()->as_array();

		$list_options = array();
		foreach($items as $item)
			$list_options[$item['id']] = $item['account_number'].' -- '.$item['name'];

		return $list_options;
	}
}
