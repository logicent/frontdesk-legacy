<?php
use Orm\Model_Soft;

class Model_Sales_Invoice_Item extends Model_Soft
{
	protected static $_properties = array(
		'id',
		'item_id',
		'invoice_id',
		'gl_account_id',
		'description',
		'qty',
		'unit_price',
		'discount_percent',
		'amount',
		'deleted_at'
	);

	protected static $_soft_delete = array(
        //'deleted_field' => 'deleted',
        'mysql_timestamp' => true,
    );

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('item_id', 'Item ID', 'required|valid_string[numeric]');
		$val->add_field('invoice_id', 'Invoice no.', 'required|valid_string[numeric]');
		$val->add_field('gl_account_id', 'GL Account ID', 'valid_string[numeric]');
		$val->add_field('description', 'Description', 'max_length[140]');
		$val->add_field('qty', 'Qty', 'required');
		$val->add_field('unit_price', 'Unit Price', 'required');
		$val->add_field('discount_percent', 'Discount Percent', 'valid_string[numeric]');
		$val->add_field('amount', 'Amount', 'required');

		return $val;
	}

	protected static $_table_name = 'sales_invoice_item';

	protected static $_belongs_to = array(
		'invoice' => array(
			'key_from' => 'invoice_id',
			'model_to' => 'Model_Sales_Invoice',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	public static function listOptions()
	{
		$items = DB::select('id','description')->from(self::$_table_name)->execute()->as_array();

		$list_options = array();
		foreach($items as $item)
			$list_options[$item['id']] = $item['description'];

		return $list_options;
	}
}
