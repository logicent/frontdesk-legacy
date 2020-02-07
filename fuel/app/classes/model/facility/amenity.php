<?php
use Orm\Model;

class Model_Facility_Amenity extends Model
{
	protected static $_properties = array(
        'id',
        'code',
        'name',
        'is_billable',
        'is_metered',
        'is_default',        
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
		$val->add_field('code', 'Code', 'required');
        $val->add_field('name', 'Name', 'required');
        // $val->add_field('is_billable', 'Is Billable', '');
        // $val->add_field('is_metered', 'Is Metered', '');
        // $val->add_field('is_default', 'Is Default', '');
        
		return $val;
	}

}
