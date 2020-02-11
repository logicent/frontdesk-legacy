<?php

namespace Fuel\Migrations;

class Create_sales_invoice_item
{
	public function up()
	{
		\DBUtil::create_table('sales_invoice_item', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'item_id' => array('constraint' => 11, 'type' => 'int'),
			'invoice_id' => array('constraint' => 11, 'type' => 'int'),
			'gl_account_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'description' => array('type' => 'text'),
			'qty' => array('type' => 'decimal'),
			'unit_price' => array('type' => 'decimal'),
			'discount_percent' => array('type' => 'double'),
			'amount' => array('type' => 'decimal'),
			'deleted_at' => array('type' => 'datetime'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('sales_invoice_item');
	}
}
