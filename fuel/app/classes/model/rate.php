<?php
use Orm\Model;

class Model_Rate extends Model
{
	protected static $_properties = array(
		'id',
		'rate_id',
		'type_id',
		'description',
        'amount',
        'charges',
        'billing_period',
        'applicable_tax',
        'channels',
        'is_tax_incl',
        'enabled',
        'rate_group',
        'valid_from',
        'valid_until',
        'fdesk_user',
        'created_at',
        'updated_at',
        'deleted_at',
	);

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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('rate_id', 'Rate Type', 'required|valid_string[numeric]');
		$val->add_field('type_id', 'Unit Type', 'required|valid_string[numeric]');
		$val->add_field('description', 'Description', 'max_length[140]');
		// $val->add_field('amount', 'Amount', 'required');
		$val->add_field('charges', 'Charges', 'required');

		return $val;
	}

	protected static $_table_name = 'rate';

	protected static $_belongs_to = array(
		'rate_type' => array(
			'key_from' => 'rate_id',
			'model_to' => 'Model_Rate_Type',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'unit_type' => array(
			'key_from' => 'type_id',
			'model_to' => 'Model_Unit_Type',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	public static function listOptions($type_id = null)
	{
		$items = DB::select('id','rate_id','type_id')
							->from(self::$_table_name)
							->where('type_id', $type_id)
							->execute()
							->as_array();

		$list_options = array();
		foreach($items as $item) {
			$rate = Model_Rate_Type::find($item['rate_id'])->name;
			$type = Model_Unit_Type::find($item['type_id'])->name;
			$list_options[$item['id']] = $type.'&ndash;'.$rate;
		}

		return $list_options;
    }
    
    public static function listOptionsRateGroup()
    {
        return array(
            'Derived' => 'Derived',
            'Standard' => 'Standard',
            'Package' => 'Package',
            'Corporate' => 'Corporate',
            'Negotiated' => 'Negotiated',
        );
    }

}
