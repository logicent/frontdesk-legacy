<?php

namespace Fuel\Migrations;

class Create_rate_type
{
	public function up()
	{
		\DBUtil::create_table('rate_type', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
			'description' => array('type' => 'text', 'null' => true),
            'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
            'enabled' => array('constraint' => 1, 'type' => 'tinyint', 'null' => true, 'default' => 1),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
            'deleted_at' => array('type' => 'datetime', 'null' => true),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rate_type');
	}
}