<?php

namespace Fuel\Migrations;

class Create_room_type
{
	public function up()
	{
		\DBUtil::create_table('room_type', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
            'description' => array('type' => 'text', 'null' => true),
            'base_rate' => array('type' => 'decimal', 'default' => 0.00), // use in costing a sale
            'is_rental' => array('type' => 'tinyint', 'default' => 0),
            'deposit_required' => array('type' => 'tinyint', 'default' => 0),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
            'deleted_at' => array('type' => 'datetime', 'null' => true),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('room_type');
	}
}