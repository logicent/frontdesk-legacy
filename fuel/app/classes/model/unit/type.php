<?php
use Orm\Model;

class Model_Unit_Type extends Model
{
	protected static $_properties = array(
        'id',
        'property_id',
        'code',
		'name',
        'description',
        'alias',
        'base_rate',
        'used_for', // used_for accommodation/rental/hire
        'inactive',
        'ota_mappings',
        'amenities',
        'image_path',
        'fdesk_user',
        'max_persons',
        'default_pax',
        'created_at',
        'updated_at',
        'deleted_at',
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('code', 'Name', 'max_length[20]');
		$val->add_field('name', 'Name', 'required|max_length[140]');
		$val->add_field('property_id', 'Property', 'required');
		$val->add_field('used_for', 'Used For', 'required');
		$val->add_field('alias', 'Alias', 'max_length[140]');
		$val->add_field('base_rate', 'Base Rate', 'valid_string[numeric]');
		$val->add_field('max_persons', 'Max Persons', 'valid_string[numeric]');
		$val->add_field('default_pax', 'Default Pax', 'valid_string[numeric]');

		return $val;
	}

	protected static $_table_name = 'unit_type';

    protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
    );
    
	public static function listOptions()
	{
		$items = DB::select('id','name')->from(self::$_table_name)->execute()->as_array();

        $list_options = array();
        
		foreach($items as $item)
			$list_options[$item['id']] = $item['name'];

		return $list_options;
	}

	protected static $_has_many = array(
		'units' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Unit',
			'key_to' => 'unit_type',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'rates' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Rate',
			'key_to' => 'type_id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
    );
    
    public static function listOptionsUsedFor()
    {
        // get from service type
        return array(
            // accommodation
            'A' => 'Accommodation',
            'R' => 'Rental',
            // 'RR' => 'Rental Residential',
            // 'RC' => 'Rental Commercial',
            'H' => 'Hire',
        );
    }
}
