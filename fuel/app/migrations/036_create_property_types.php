<?php

namespace Fuel\Migrations;

class Create_property_types
{
	public function up()
	{
		\DBUtil::create_table('property_types', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'auto_increment' => true, 'constraint' => '11'),
			'code' => array('constraint' => 20, 'type' => 'varchar'),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
            'enabled' => array('type' => 'boolean', 'default' => 1, 'null' => true),
			// 'discontinued' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 0, 'null' => true),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
            'updated_at' => array('constraint' => 11, 'type' => 'int'),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('property_types');
	}
}