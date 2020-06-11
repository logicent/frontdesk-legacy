<?php
use Orm\Model;

class Model_Service_Item extends Model
{
	protected static $_properties = array(
		'id',
		'code',
		'description',
		'qty',
		'unit_price',
        'discount_percent',
		'gl_account_id',
        'fdesk_user',
        'service_type',
        'enabled',
        'billable',
		'created_at',
        'updated_at',
	);


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('code', 'Code', 'required|max_length[20]');
		$val->add_field('gl_account_id', 'GL Account', 'valid_string[numeric]');
		$val->add_field('description', 'Description', 'required|max_length[140]');
		$val->add_field('qty', 'Units', 'valid_string[numeric]');
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

    public static function listOptions($selected, $billable = true)
    {
		$query = DB::select('id', 'description')
                    ->from(self::$_table_name)
                    ->where([
                        'enabled' => true,
                        'billable' => $billable
					]);
		if (!empty($selected))
			$query->or_where(['id' => $selected]);
		$items = $query->order_by('description', 'ASC')
					->execute()
					->as_array();
        
		$list_options = array('' => '&nbsp;');

		foreach($items as $item) {
			$list_options[$item['id']] = $item['description'];
        }
        
		return $list_options;
    }

	public static function getSystemDefinedServiceItem($service_type = null)
	{
		return array(
			array(
				'id' => 1,
				'description' => 'Rent',
				'code' => 'RENT',
				'qty' => 1,
				'unit_price' => 0.00,
				'billable' => true,
				'enabled' => true,
				// 'service_group' => 'Lease',
				// 'is_default' => true,
			),
			array(
				'id' => 2,
				'description' => 'Deposit',
				'code' => 'DEP',
				'qty' => 1,
				'unit_price' => 0.00,
				'billable' => true,
				'enabled' => true,
				// 'service_group' => array('Lease', 'Hire'),
				// 'is_default' => false,
			),
			array(
				'id' => 3,
				'description' => 'Accommodation',
				'code' => 'ACCOM',
				'qty' => 1,
				'unit_price' => 0.00,
				'billable' => true,
				'enabled' => true,
				// 'service_group' => 'Booking',
				// 'is_default' => true,
			),
			array(
				'id' => 4,
				'description' => 'Commission',
				'code' => 'COMM',
				'qty' => 1,
				'unit_price' => 0.00,
				'billable' => true,
				'enabled' => true,
				// 'service_group' => 'Sale',
				// 'is_default' => false,
			),
			array(
				'id' => 5,
				'description' => 'Fee',
				'code' => 'FEE',
				'qty' => 1,
				'unit_price' => 0.00,
				'billable' => true,
				'enabled' => true,
				// 'service_group' => array('Lease', 'Hire', 'Booking', 'Sale'),
				// 'is_default' => false,
			),
		);
	}
}
