<?php

namespace Fuel\Migrations;

class Create_room_type
{
	public function up()
	{
		\DBUtil::create_table('room_type', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 20, 'type' => 'varchar'),
			'description' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('room_type');
	}
}