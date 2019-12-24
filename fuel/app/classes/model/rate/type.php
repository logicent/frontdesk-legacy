<?php
use Orm\Model;

class Model_Rate_Type extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'description',
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[20]');
		$val->add_field('description', 'Description', 'max_length[255]');

		return $val;
	}

	protected static $_table_name = 'rate_type';

	protected static $_has_many = array(
		'rates' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Rate',
			'key_to' => 'rate_id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
	);

	public static function listOptions()
	{
		$items = DB::select('id','name')->from(self::$_table_name)->execute()->as_array();

		$list_options = array();
		foreach($items as $item)
			$list_options[$item['id']] = $item['name'];

		return $list_options;
	}
}
