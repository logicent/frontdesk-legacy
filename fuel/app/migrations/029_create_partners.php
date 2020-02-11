<?php

namespace Fuel\Migrations;

class Create_partners
{
	public function up()
	{
		\DBUtil::create_table('partners', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
			'name' => array('constraint' => '140', 'type' => 'varchar'),
			'type' => array('constraint' => '140', 'type' => 'varchar'),
			'inactive' => array('default' => 0, 'type' => 'boolean'),
			'credit_limit' => array('constraint' => '10,2', 'type' => 'decimal', 'default' => 0.00),
			'created_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
			'updated_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('partners');
	}
}