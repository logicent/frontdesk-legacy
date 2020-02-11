<?php

namespace Fuel\Migrations;

class Create_service_types
{
	public function up()
	{
		\DBUtil::create_table('service_types', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
			'name' => array('constraint' => '140', 'type' => 'varchar'),
			'code' => array('constraint' => '20', 'type' => 'varchar'),
			'enabled' => array('type' => 'boolean', 'default' => 1),
			'created_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
			'updated_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('service_types');
	}
}