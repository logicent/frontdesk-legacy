<?php

namespace Fuel\Migrations;

class Create_employment_type
{
	public function up()
	{
		\DBUtil::create_table('employment_type', array(
            'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
			'code' => array('constraint' => 20, 'type' => 'varchar'),
			'description' => array('constraint' => 140, 'type' => 'varchar'),
			'enabled' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 0),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
            'updated_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('employment_type');
	}
}