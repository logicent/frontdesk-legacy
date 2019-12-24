<?php

namespace Fuel\Migrations;

class Create_room
{
	public function up()
	{
		\DBUtil::create_table('room', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 10, 'type' => 'varchar'),
			'room_type' => array('constraint' => 11, 'type' => 'int'),
			'alias' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'status' => array('constraint' => 3, 'type' => 'char'),
			'hk_status' => array('constraint' => 3, 'type' => 'char'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('room');
	}
}