<?php

namespace Fuel\Migrations;

class Create_business
{
	public function up()
	{
		\DBUtil::create_table('business', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'business_name' => array('constraint' => 150, 'type' => 'varchar'),
			'trading_name' => array('constraint' => 150, 'type' => 'varchar'),
			'address' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'tax_identifier' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'tax_rate' => array('type' => 'double', 'null' => true),
			'currency_symbol' => array('constraint' => 3, 'type' => 'char', 'null' => true),
			'email_address' => array('constraint' => 50, 'type' => 'varchar', 'null' => true),
			'business_logo' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('business');
	}
}
