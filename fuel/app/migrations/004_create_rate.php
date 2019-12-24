<?php

namespace Fuel\Migrations;

class Create_rate
{
	public function up()
	{
		\DBUtil::create_table('rate', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'rate_id' => array('constraint' => 11, 'type' => 'int'),
			'type_id' => array('constraint' => 11, 'type' => 'int'),
			'description' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'charges' => array('type' => 'double', 'default' => 0),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rate');
	}
}