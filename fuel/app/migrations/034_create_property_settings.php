<?php

namespace Fuel\Migrations;

class Create_property_settings
{
	public function up()
	{
		\DBUtil::create_table('property_settings', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'auto_increment' => true, 'constraint' => '11'),
			'property_id' => array('constraint' => '11', 'type' => 'int'),
			'key' => array('constraint' => '140', 'type' => 'varchar'),
			'value' => array('constraint' => '140', 'null' => true, 'type' => 'varchar'),
			'created_at' => array('constraint' => '11', 'type' => 'int'),
            'updated_at' => array('constraint' => '11', 'type' => 'int'),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('property_settings');
	}
}