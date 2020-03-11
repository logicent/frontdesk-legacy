<?php

namespace Fuel\Migrations;

class Create_designation
{
	public function up()
	{
		\DBUtil::create_table('designation', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'auto_increment' => true, 'constraint' => '11'),
			'code' => array('constraint' => 20, 'type' => 'varchar'),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
			'description' => array('constraint' => 280, 'type' => 'text', 'null' => true),
            'enabled' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 1, 'null' => true), // discontinued
			'reports_to' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
            'updated_at' => array('constraint' => 11, 'type' => 'int'),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('designation');
	}
}