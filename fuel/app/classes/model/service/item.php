<?php
use Orm\Model;

class Model_Service_Item extends Model
{
	protected static $_properties = array(
		'id',
		'item',
		'gl_account_id',
		'description',
		'qty',
		'unit_price',
		'discount_percent',
	);


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('item', 'Item', 'required|max_length[20]');
		$val->add_field('gl_account_id', 'GL Account ID', 'valid_string[numeric]');
		$val->add_field('description', 'Description', 'required|max_length[255]');
		$val->add_field('qty', 'Qty', 'valid_string[numeric]');
		$val->add_field('unit_price', 'Unit Price', 'valid_string[]');
		$val->add_field('discount_percent', 'Discount %', 'valid_string[]');

		return $val;
	}

	protected static $_table_name = 'service_item';

	public static function getColumnDefault( $name )
	{
		$col_def = DB::list_columns(self::$_table_name, "$name");
		return $col_def["$name"]['default'];
	}
}
