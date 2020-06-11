<?php

namespace Fuel\Migrations;

class Create_sales_order_item
{
	public function up()
	{
		\DBUtil::create_table('sales_order_item', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'item_id' => array('constraint' => 11, 'type' => 'int'),
			'invoice_id' => array('constraint' => 11, 'type' => 'int'),
			'gl_account_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'description' => array('type' => 'text', 'null' => true),
			'qty' => array('constraint' => [12,4], 'type' => 'decimal'),
			'unit_price' => array('constraint' => [12,4], 'type' => 'decimal'),
			'discount_percent' => array('constraint' => [12,4], 'type' => 'decimal'),
			'amount' => array('constraint' => [12,4], 'type' => 'decimal'),
			'deleted_at' => array('type' => 'datetime', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('sales_order_item');
	}
}
