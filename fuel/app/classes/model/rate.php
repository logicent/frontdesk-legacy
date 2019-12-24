<?php
use Orm\Model;

class Model_Rate extends Model
{
	protected static $_properties = array(
		'id',
		'rate_id',
		'type_id',
		'description',
		'charges',
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('rate_id', 'Rate Type', 'required|valid_string[numeric]');
		$val->add_field('type_id', 'Room Type', 'required|valid_string[numeric]');
		$val->add_field('description', 'Description', 'max_length[255]');
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
		'room_type' => array(
			'key_from' => 'type_id',
			'model_to' => 'Model_Room_Type',
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
			$type = Model_Room_Type::find($item['type_id'])->name;
			$list_options[$item['id']] = $type.'&ndash;'.$rate;
		}

		return $list_options;
	}
}
