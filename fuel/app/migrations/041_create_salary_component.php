<?php

namespace Fuel\Migrations;

class Create_salary_component
{
	public function up()
	{
		\DBUtil::create_table('salary_component', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'auto_increment' => true, 'constraint' => '11'),
			'code' => array('constraint' => 20, 'type' => 'varchar'),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
			'description' => array('constraint' => 280, 'type' => 'text', 'null' => true),
            'enabled' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 1, 'null' => true),
            'is_payable' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 1, 'null' => true),
            'is_tax_applicable' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 1, 'null' => true),
            'depends_on_payment_days' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 0, 'null' => true),
			'type' => array('constraint' => 140, 'type' => 'varchar'),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
            'updated_at' => array('constraint' => 11, 'type' => 'int'),
            'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('salary_component');
	}
}