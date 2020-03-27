<?php

namespace Fuel\Migrations;

class Create_employee_attendance
{
	public function up()
	{
		\DBUtil::create_table('employee_attendance', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
			'employee_id' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
			'work_day' => array('null' => false, 'type' => 'date'),
			'status' => array('constraint' => '255', 'null' => false, 'type' => 'varchar'),
			'fdesk_user' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
			'created_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
			'updated_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('employee_attendance');
	}
}