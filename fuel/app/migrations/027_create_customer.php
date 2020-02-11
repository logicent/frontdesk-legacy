<?php

namespace Fuel\Migrations;

class Create_customer
{
	public function up()
	{
		\DBUtil::create_table('customer', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'customer_name' => array('constraint' => 140, 'type' => 'varchar'),
			'account_manager' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'customer_type' => array('constraint' => 140, 'type' => 'varchar'),
			'bank_account' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'billing_currency' => array('constraint' => 3, 'type' => 'char', 'default' => 'KES'),
			'default_rate_ref' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'tax_id' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'customer_group' => array('constraint' => 140, 'type' => 'varchar'),
			'mobile_phone' => array('constraint' => 140, 'type' => 'varchar'),
			'email_address' => array('constraint' => 140, 'type' => 'varchar', 'null' => true),
			'id_type' => array('constraint' => 3, 'type' => 'char'),
			'id_no' => array('constraint' => 8, 'type' => 'varchar'),
			'id_country' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'occupation' => array('constraint' => 140, 'type' => 'varchar'),
			'date_joined' => array('type' => 'date'),
			'date_left' => array('type' => 'date', 'null' => true),
			'inactive' => array('type' => 'tinyint', 'default' => 0),
			'credit_limit' => array('type' => 'decimal', 'default' => 0.00),
			'is_internal_customer' => array('type' => 'tinyint', 'default' => 0),
			'on_hold' => array('type' => 'tinyint', 'default' => 0),
			'on_hold_from' => array('type' => 'date', 'null' => true),
			'on_hold_to' => array('type' => 'date', 'null' => true),
			'remarks' => array('type' => 'text', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('customer');
	}
}