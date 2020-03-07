<?php

namespace Fuel\Migrations;

class Create_employee
{
	public function up()
	{
		\DBUtil::create_table('employee', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'employee_name' => array('constraint' => 140, 'type' => 'varchar'),
			'manager_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'employee_type' => array('constraint' => 140, 'type' => 'varchar'),
			'bank_account' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'base_salary' => array('constraint' => array(10,2), 'type' => 'decimal', 'null' => true),
			'tax_ID' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
            'employee_group' => array('constraint' => 140, 'type' => 'varchar', 'null' => true),
			'sex' => array('constraint' => 1, 'type' => 'char'),
			'title_of_courtesy' => array('constraint' => 3, 'type' => 'char', 'null' => true),
			'birth_date' => array('type' => 'date', 'null' => true),            
			'mobile_phone' => array('constraint' => 140, 'type' => 'varchar', 'unique' => true),
			'email_address' => array('constraint' => 140, 'type' => 'varchar', 'null' => true),
			'ID_type' => array('constraint' => 3, 'type' => 'char'),
			'ID_no' => array('constraint' => 8, 'type' => 'varchar'),
            'ID_country' => array('constraint' => 3, 'type' => 'char'),
            'ID_attachment' => array('constraint' => 140, 'type' => 'varchar', 'null' => true),
			'occupation' => array('constraint' => 140, 'type' => 'varchar', 'null' => true),
			'date_joined' => array('type' => 'date', 'null' => true),
			'date_left' => array('type' => 'date', 'null' => true),
			'inactive' => array('type' => 'tinyint', 'default' => 0, 'null' => true),
			// 'is_seconded_employee' => array('type' => 'tinyint', 'default' => 0, 'null' => true),
			'on_hold' => array('type' => 'tinyint', 'default' => 0, 'null' => true),
			'on_hold_from' => array('type' => 'date', 'null' => true),
			'on_hold_to' => array('type' => 'date', 'null' => true),
            'remarks' => array('type' => 'text', 'null' => true),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('employee');
	}
}