<?php

namespace Fuel\Migrations;

class Create_countries
{
	public function up()
	{
		\DBUtil::create_table('countries', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'sequence' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 128, 'type' => 'varchar'),
			'iso_code_2' => array('constraint' => 2, 'type' => 'varchar'),
			'iso_code_3' => array('constraint' => 3, 'type' => 'varchar'),
			'address_format' => array('type' => 'text'),
			'zip_required' => array('constraint' => 1, 'type' => 'int'),
			'status' => array('constraint' => 1, 'type' => 'int'),
			'tax' => array('type' => 'float'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('countries');
	}
}