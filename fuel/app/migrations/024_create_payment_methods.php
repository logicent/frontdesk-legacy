<?php

namespace Fuel\Migrations;

class Create_payment_methods
{
	public function up()
	{
		\DBUtil::create_table('payment_methods', array(
            'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
			'code' => array('constraint' => 20, 'type' => 'varchar'),
            'name' => array('constraint' => 140, 'type' => 'varchar'),
			'is_default' => array('constraint' => 1, 'type' => 'tinyint', 'null' => true),
			'enabled' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 1),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'datetime'),
            'updated_at' => array('type' => 'datetime'),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('payment_methods');
	}
}