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
