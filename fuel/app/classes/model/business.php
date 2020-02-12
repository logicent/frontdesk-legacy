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
		'property_type',
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
		$val->add_field('property_type', 'Property Type', 'required');
		$val->add_field('currency_symbol', 'Currency Symbol', 'max_length[3]');
		$val->add_field('email_address', 'Email Address(es)', 'max_length[140]');
		$val->add_field('phone_number', 'Phone Number(s)', 'max_length[140]');
		$val->add_field('business_logo', 'Business Logo', 'max_length[140]');

		return $val;
	}

    protected static $_table_name = 'business';
    
    public static function listOptions()
	{
		return array(
            // accommodation
            'Hotel_or_City_Hotel' => 'Hotel / City Hotel',
            'BnB_or_Inn_or_Lodge' => 'BnB / Inn / Lodge',
            'Guest_House' => 'Guest House',
            'Resort' => 'Resort',
            // membership
            'Gym_or_Spa' => 'Gym / Spa',
            'Sports_Club' => 'Sports Club',
            // rental
            'Hostel' => 'Hostel',
            'Residential' => 'Residential',
            'Serviced_Apartments' => 'Serviced Apartments',
            'Commercial' => 'Commercial',
            // accommodation, rentals, membership, hires
            'Mixed-use_or_Multi-property' => 'Mixed-use / Multi-property',
        );
	}

}
