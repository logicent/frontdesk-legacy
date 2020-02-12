<?php

namespace Fuel\Migrations;

class Create_room
{
	public function up()
	{
		\DBUtil::create_table('room', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 20, 'type' => 'varchar'),
			'room_type' => array('constraint' => 11, 'type' => 'int'),
			'alias' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'status' => array('constraint' => 3, 'type' => 'char'),
            'hk_status' => array('constraint' => 3, 'type' => 'char'),
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
		\DBUtil::drop_table('room');
	}
}