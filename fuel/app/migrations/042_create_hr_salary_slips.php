<?php

namespace Fuel\Migrations;

class Create_hr_salary_slips
{
	public function up()
	{
		\DBUtil::create_table('hr_salary_slips', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
			'code' => array('constraint' => '20', 'type' => 'varchar', '20' => true),
			'name' => array('constraint' => '140', 'type' => 'varchar', '140' => true),
			'employee_id' => array('constraint' => '11', 'type' => 'int'),
			'designation' => array('constraint' => '140', 'type' => 'varchar'),
			'start_date' => array('type' => 'date'),
			'end_date' => array('type' => 'date'),
			'status' => array('constraint' => '20', 'type' => 'varchar'),
			'date_paid' => array('null' => true, 'type' => 'date'),
			'date_due' => array('type' => 'date'),
			'payroll_period' => array('constraint' => '20', 'type' => 'varchar'),
			'total_deductions' => array('constraint' => '10,2', 'type' => 'decimal'),
			'total_earnings' => array('constraint' => '10,2', 'type' => 'decimal'),
			'total_gross' => array('constraint' => '10,2', 'type' => 'decimal'),
			'net_amount' => array('constraint' => '10,2', 'type' => 'decimal'),
			'fdesk_user' => array('constraint' => '11', 'type' => 'int'),
			'created_at' => array('constraint' => '11', 'type' => 'int'),
			'updated_at' => array('constraint' => '11', 'type' => 'int'),
			'deleted_at' => array('constraint' => '11', 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('hr_salary_slips');
	}
}