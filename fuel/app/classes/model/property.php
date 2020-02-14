<?php
use Orm\Model;

class Model_Property extends Model
{
	protected static $_properties = array(
		'id',
		'code',
		'name',
		'description',
		'physical_address',
		'map_location',
		'property_type',
		'owner',
		'ID_attachment',
		'property_ref',
		'date_signed',
		'date_released',
		'inactive',
		'on_hold',
		'on_hold_from',
		'on_hold_to',
        'remarks',
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
		$val->add_field('code', 'Code', 'max_length[255]');
		$val->add_field('name', 'Title', 'required|max_length[255]');
		$val->add_field('description', 'Description', 'max_length[140]');
		$val->add_field('physical_address', 'Physical Address', 'valid_string');
		$val->add_field('map_location', 'Map Location', 'valid_string');
		$val->add_field('property_type', 'Property Type', 'required');
		$val->add_field('owner', 'Owner', 'valid_string[numeric]');
		$val->add_field('property_ref', 'Property Ref', 'max_length[20]');
		// $val->add_field('date_signed', 'Date Signed', 'valid_date');
		// $val->add_field('date_released', 'Date Released', 'valid_date');
		$val->add_field('inactive', 'Inactive', 'valid_string[numeric]');
		$val->add_field('on_hold', 'On Hold', 'valid_string[numeric]');
		$val->add_field('on_hold_from', 'On Hold From', 'valid_date');
		$val->add_field('on_hold_to', 'On Hold To', 'valid_date');
		$val->add_field('remarks', 'Remarks', 'max_length[255]');

        return $val;
    }

    public static function listOptions()
    {
        return array(
            // accommodation
            'H' => 'Hotel / City Hotel',
            'BnB' => 'BnB / Inn / Lodge',
            'GH' => 'Guest House',
            'RSRT' => 'Resort',
            // membership
            'G/S' => 'Gym / Spa',
            'SC' => 'Sports Club',
            // rental
            'HSTL' => 'Hostel',
            'R' => 'Residential',
            'SA' => 'Serviced Apartments',
            'C' => 'Commercial',
            // accommodation, rentals, membership, hires
            'MU-MP' => 'Mixed-use / Multi-property',
        );
    }
    
}
