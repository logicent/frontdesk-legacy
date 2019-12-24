<?php

namespace Fuel\Migrations;

class Create_bank_account
{
	public function up()
	{
		\DBUtil::create_table('bank_account', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 150, 'type' => 'varchar'),
			'account_number' => array('constraint' => 20, 'type' => 'varchar'),
			'financial_institution' => array('constraint' => 50, 'type' => 'varchar'),
			'starting_bal' => array('type' => 'decimal'),
			'starting_date' => array('type' => 'date'),
			'i_banking_na' => array('type' => 'tinyint'),
			'last_statement_date' => array('type' => 'date'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('bank_account');
	}
}
