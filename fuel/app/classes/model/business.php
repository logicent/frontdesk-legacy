<?php
use Orm\Model;

class Model_Business extends Model
{
	protected static $_properties = array(
		'id',
		'business_name',
		'trading_name',
		'address',
		'tax_identifier',
		'tax_rate',
		'currency_symbol',
		'email_address',
		'business_logo',
	);


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('business_name', 'Business Name', 'required|max_length[150]');
		$val->add_field('trading_name', 'Trading Name', 'required|max_length[150]');
		$val->add_field('address', 'Address', 'max_length[255]');
		$val->add_field('tax_identifier', 'Tax Identifier', 'max_length[20]');
		$val->add_field('tax_rate', 'Tax Rate', 'valid_string[]');
		$val->add_field('currency_symbol', 'Currency Symbol', 'max_length[3]');
		$val->add_field('email_address', 'Email Address', 'max_length[50]');
		$val->add_field('business_logo', 'Business Logo', 'max_length[255]');

		return $val;
	}

	protected static $_table_name = 'business';
}
