<?php
use Orm\Model;

class Model_Property_Setting extends Model
{
	protected static $_properties = array(
		'id',
		'property_id',
		'key',
		'value',
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

    // set up the Property relation the usual way
    protected static $_belongs_to = array(
        'property' => array(
            'key_from' => 'property_id',
            'model_to' => 'Model_Property',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => true,
        )
    );
    
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('property_id', 'Property Id', 'required|valid_string[numeric]');
		$val->add_field('key', 'Key', 'required|max_length[255]');
		$val->add_field('value', 'Value', 'required|max_length[255]');

		return $val;
	}

}
