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
		'business_type',
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
            'PO'    => 'Property Owner',
            'PA'    => 'Property Agent',
            'POPA'  => 'Property Owner / Property Agent',
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
