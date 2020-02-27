<?php

namespace Fuel\Migrations;

class Create_service_types
{
	public function up()
	{
		\DBUtil::create_table('service_types', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'auto_increment' => true, 'constraint' => '11'),
			'code' => array('constraint' => 20, 'type' => 'varchar'),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
            'enabled' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 1, 'null' => true), // discontinued
			'is_default' => array('constraint' => 1, 'type' => 'tinyint', 'null' => true),
			'default_service_provider' => array('constraint' => 11, 'type' => 'int', 'null' => true), // supplier i.e. partner
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
            'updated_at' => array('constraint' => 11, 'type' => 'int'),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('service_types');
	}
}