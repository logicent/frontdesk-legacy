<?php
use Orm\Model;

class Model_Property extends Model
{
    // accommodation
    public const PROPERTY_TYPE_HOTEL        = 'H/CH'; // Hotel / City Hotel
    public const PROPERTY_TYPE_BNB          = 'B/I/L'; // BnB / Inn / Lodge
    public const PROPERTY_TYPE_GUEST_HOUSE  = 'GH'; // Guest House
    public const PROPERTY_TYPE_RESORT       = 'RSRT'; // Resort
    // membership
    public const PROPERTY_TYPE_GYM_SPA      = 'G/S'; // Gym / Spa
    public const PROPERTY_TYPE_SPORTS_CLUB  = 'SC'; // Sports Club
    // rental
    public const PROPERTY_TYPE_HOSTEL       = 'HSTL'; // Hostel
    public const PROPERTY_TYPE_RESIDENTIAL  = 'RSDTL'; // Residential ( Apartment or Maisonette / Bungalow )
    public const PROPERTY_TYPE_COMMERCIAL   = 'COM';
    public const PROPERTY_TYPE_SERVICED_APARTMENT = 'SA';
    // accommodation, rentals, membership, hires
    public const PROPERTY_TYPE_MIXED_USE    = 'MUMP'; // Mixed-use / Multi-property
    
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

        
	protected static $_belongs_to = array(
		'propertyOwner' => array(
			'key_from' => 'owner',
			'model_to' => 'Model_Customer',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
    );
    
    protected static $_has_many = array(
        'property_settings' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Property_Setting',
            'key_to' => 'property_id',
            'cascade_save' => true,
            'cascade_delete' => true,
        )
    );

    // define the (EAV) Settings container as below
    protected static $_eav = array(
        'property_settings' => array(
            'attribute' => 'key',
            'value' => 'value',
        )
    );

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('code', 'Code', 'max_length[255]');
		$val->add_field('name', 'Title', 'required|max_length[255]');
		$val->add_field('description', 'Description', 'max_length[140]');
		// $val->add_field('physical_address', 'Physical Address', 'valid_string');
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

    public static function listOptionsPropertyType()
    {
        return array(
            // ACCOMODATION
            self::PROPERTY_TYPE_HOTEL                   => 'Hotel / City Hotel',
            self::PROPERTY_TYPE_BNB                     => 'BnB / Inn / Lodge',
            self::PROPERTY_TYPE_GUEST_HOUSE             => 'Guest House',
            self::PROPERTY_TYPE_RESORT                  => 'Resort',
            // MEMBERSHIP
            self::PROPERTY_TYPE_GYM_SPA                 => 'Gym / Spa',
            self::PROPERTY_TYPE_SPORTS_CLUB             => 'Sports Club',
            // RENTAL
            self::PROPERTY_TYPE_HOSTEL                  => 'Hostel',
            self::PROPERTY_TYPE_RESIDENTIAL             => 'Residential',
            self::PROPERTY_TYPE_COMMERCIAL              => 'Commercial',
            self::PROPERTY_TYPE_SERVICED_APARTMENTS     => 'Serviced Apartments',
            // ACCOMMODATION, RENTAL, MEMBERSHIP, HIRE
            self::PROPERTY_TYPE_MIXED_USE               => 'Mixed-use / Multi-property',
        );
    }

    public static function listOptionsPropertyOwner()
	{
		$items = DB::select('id','customer_name')
						->from('customer')
						->where(['customer_type' => 'Owner'])
						->execute()
						->as_array();

		$list_options = array('' => '');

		foreach($items as $item) {
			$list_options[$item['id']] = $item['customer_name'];
        }
        
		return $list_options;
	}
    
    public static function listOptionsProperty($owner = null)
	{
		$items = DB::select('id','name')
						->from('properties')
                        ->where(['inactive' => false])
                        ->and_where(['owner' => $owner])
						->execute()
						->as_array();

        if (!$owner)
		    $list_options = array('' => '');
        else
            $list_options = array();
        
		foreach($items as $item) {
			$list_options[$item['id']] = $item['name'];
        }
        
		return $list_options;
	}
}
