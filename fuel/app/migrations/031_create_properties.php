<?php

namespace Fuel\Migrations;

class Create_properties
{
	public function up()
	{
		\DBUtil::create_table('properties', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'auto_increment' => true, 'constraint' => '11'),
			'code' => array('constraint' => '20', 'null' => true, 'type' => 'varchar'),
			'name' => array('constraint' => '140', 'type' => 'varchar'),
			'description' => array('constraint' => '140', 'null' => true, 'type' => 'varchar'),
			'physical_address' => array('constraint' => '140', 'null' => true, 'type' => 'varchar'),
			'map_location' => array('constraint' => '140', 'null' => true, 'type' => 'varchar'),
			'property_type' => array('constraint' => '20', 'type' => 'varchar'),
			'owner' => array('constraint' => '11', 'type' => 'int', 'null' => true),
			'ID_attachment' => array('constraint' => '140', 'type' => 'varchar', 'null' => true),
			'property_ref' => array('constraint' => '140', 'type' => 'varchar'),
			'date_signed' => array('null' => true, 'type' => 'date'),
			'date_released' => array('null' => true, 'type' => 'date'),
			'inactive' => array('null' => true, 'type' => 'boolean', 'default' => 0),
			'on_hold' => array('null' => true, 'type' => 'boolean'),
			'on_hold_from' => array('null' => true, 'type' => 'date'),
			'on_hold_to' => array('null' => true, 'type' => 'date'),
            'remarks' => array('null' => true, 'type' => 'text'),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => '11', 'type' => 'int'),
			'updated_at' => array('constraint' => '11', 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('properties');
	}
}