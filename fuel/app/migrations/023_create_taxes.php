<?php

namespace Fuel\Migrations;

class Create_taxes
{
	public function up()
	{
		\DBUtil::create_table('taxes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'code' => array('constraint' => 20, 'type' => 'varchar'),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
			'type' => array('constraint' => 140, 'type' => 'varchar'), // Fixed, Normal, Inclusive, Compound
            'rate' => array('type' => 'decimal'),
            'enabled' => array('type' => 'tinyint', 'default' => 1),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'datetime'),
            'updated_at' => array('type' => 'datetime'),
            
        ), array('id'));
        
	}

	public function down()
	{
		\DBUtil::drop_table('taxes');
	}
}