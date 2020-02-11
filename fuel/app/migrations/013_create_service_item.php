<?php

namespace Fuel\Migrations;

class Create_service_item
{
	public function up()
	{
		\DBUtil::create_table('service_item', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'item' => array('constraint' => 20, 'type' => 'varchar'),
			'service_type' => array('constraint' => 11, 'type' => 'int'),
			'gl_account_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'description' => array('constraint' => 255, 'type' => 'varchar'),
			'qty' => array('constraint' => 4, 'type' => 'int'),
			'unit_price' => array('type' => 'double', 'null' => true),
			'discount_percent' => array('type' => 'double', 'null' => true),
            'billable' => array('type' => 'tinyint', 'default' => 1),
                        

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('service_item');
	}
}
