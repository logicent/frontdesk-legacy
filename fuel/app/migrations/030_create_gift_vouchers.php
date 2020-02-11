<?php

namespace Fuel\Migrations;

class Create_gift_vouchers
{
	public function up()
	{
		\DBUtil::create_table('gift_vouchers', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
			'code' => array('constraint' => '140', 'type' => 'varchar', 'unique' => true),
			'name' => array('constraint' => '140', 'type' => 'varchar'),
			'type' => array('constraint' => '140', 'type' => 'varchar'),
			'valid_from' => array('null' => true, 'type' => 'date'),
			'valid_to' => array('null' => true, 'type' => 'date'),
			'value' => array('constraint' => '10,2', 'type' => 'decimal'),
			'is_redeemed' => array('null' => false, 'type' => 'boolean'),
			'created_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
			'updated_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('gift_vouchers');
	}
}