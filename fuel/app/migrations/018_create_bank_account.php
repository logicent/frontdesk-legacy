<?php

namespace Fuel\Migrations;

class Create_bank_account
{
	public function up()
	{
		\DBUtil::create_table('bank_account', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
			'number' => array('constraint' => 140, 'type' => 'varchar'),
			'bank_name' => array('constraint' => 140, 'type' => 'varchar'),
			'bank_phone' => array('constraint' => 140, 'type' => 'varchar', 'null' => true),
			'bank_address' => array('constraint' => 280, 'type' => 'varchar'),
			'currency' => array('constraint' => 3, 'type' => 'char'),
			'opening_balance' => array('constraint' => '15,4', 'type' => 'decimal', 'null' => true),
			'is_default' => array('type' => 'tinyint', 'null' => true),
			'enabled' => array('type' => 'tinyint', 'null' => true),
            'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
            'deleted_at' => array('type' => 'datetime', 'null' => true),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('bank_account');
	}
}
