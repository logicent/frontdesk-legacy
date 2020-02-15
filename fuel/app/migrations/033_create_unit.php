<?php

namespace Fuel\Migrations;

class Create_unit
{
	public function up()
	{
		\DBUtil::create_table('unit', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'prefix' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'name' => array('constraint' => 20, 'type' => 'varchar'),
			'unit_type' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 3, 'type' => 'char'),
            'hk_status' => array('constraint' => 3, 'type' => 'char'),
            'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
            'deleted_at' => array('type' => 'datetime', 'null' => true),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('unit');
	}
}