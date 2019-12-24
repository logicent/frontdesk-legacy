<?php

namespace Fuel\Migrations;

class Create_rate_type
{
	public function up()
	{
		\DBUtil::create_table('rate_type', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 20, 'type' => 'varchar'),
			'description' => array('constraint' => 255, 'type' => 'varchar'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rate_type');
	}
}