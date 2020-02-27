<?php
use Orm\Model;

class Model_Property_Type extends Model
{
    // ACCOMODATION
    public const PROPERTY_TYPE_HOTEL        = 'H/CH'; // Hotel / City Hotel
    public const PROPERTY_TYPE_BNB          = 'B/I/L'; // BnB / Inn / Lodge
    public const PROPERTY_TYPE_GUEST_HOUSE  = 'GH'; // Guest House
    public const PROPERTY_TYPE_RESORT       = 'RSRT'; // Resort
    // MEMBERSHIP
    public const PROPERTY_TYPE_GYM_SPA      = 'G/S'; // Gym / Spa
    public const PROPERTY_TYPE_SPORTS_CLUB  = 'SC'; // Sports Club
    // RENTAL
    public const PROPERTY_TYPE_HOSTEL       = 'HSTL'; // Hostel
    public const PROPERTY_TYPE_RESIDENTIAL  = 'RES'; // Residential ( Apartment or Maisonette / Bungalow )
    public const PROPERTY_TYPE_COMMERCIAL   = 'COM';
    public const PROPERTY_TYPE_SERVICED_APARTMENT = 'SA';
    // ACCOMMODATION, RENTAL, MEMBERSHIP, HIRE
    public const PROPERTY_TYPE_MIXED_USE    = 'MU/MP'; // Mixed-use / Multi-property
    
	protected static $_properties = array(
        'id',
        'code',
        'name',
        'enabled',
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
		$val->add_field('code', 'Code', 'required|max_length[20]');
		$val->add_field('name', 'Desciption', 'required|max_length[140]');
        
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
            self::PROPERTY_TYPE_SERVICED_APARTMENT      => 'Serviced Apartments',
            // ACCOMMODATION, RENTAL, MEMBERSHIP, HIRE
            self::PROPERTY_TYPE_MIXED_USE               => 'Mixed-use / Multi-property',
        );
    }
}
