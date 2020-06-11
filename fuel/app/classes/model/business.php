<?php
use Orm\Model;

class Model_Business extends Model
{
	const BUSINESS_TYPE_PROPERTY_OWNER = 'PO';
	const BUSINESS_TYPE_PROPERTY_AGENT = 'PA';
	const BUSINESS_TYPE_PROPERTY_OWNER_AGENT = 'PO_A';

	protected static $_properties = array(
		'id',
		'business_name',
		'trading_name',
		'address',
		'tax_identifier',
		'business_type',
		'service_accommodation',
		'service_rental',
		'service_hire',
		'service_sale',
		'currency_symbol',
        'email_address',
        'phone_number',
		'business_logo',
	);


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('business_name', 'Business Name', 'required|max_length[140]');
		$val->add_field('trading_name', 'Trading Name', 'required|max_length[140]');
		$val->add_field('address', 'Address', 'max_length[255]');
		$val->add_field('tax_identifier', 'Tax Identifier', 'max_length[20]');
		$val->add_field('business_type', 'Business Type', 'required');
		$val->add_field('currency_symbol', 'Currency Symbol', 'max_length[3]');
		$val->add_field('email_address', 'Email Address(es)', 'max_length[140]');
		$val->add_field('phone_number', 'Phone Number(s)', 'max_length[140]');
		$val->add_field('business_logo', 'Business Logo', 'max_length[140]');

		return $val;
	}

    protected static $_table_name = 'business';
    
    public static function listOptionsType()
	{
		return array(
            self::BUSINESS_TYPE_PROPERTY_OWNER	=> 'Property Owner',
            self::BUSINESS_TYPE_PROPERTY_AGENT	=> 'Property Agent / Manager',
            self::BUSINESS_TYPE_PROPERTY_OWNER_AGENT  => 'Property Owner & Agent',
        );
	}

	public static function listOptionsCurrency()
	{
		$items = DB::select('currency_code', 'currency')->from('countries')->order_by('currency')->execute()->as_array();
        
        $list_options = array( '' =>  '' );
		
		foreach($items as $item)
			$list_options[$item['currency_code']] = ucwords($item['currency']);
		
		return $list_options;
	}
}
