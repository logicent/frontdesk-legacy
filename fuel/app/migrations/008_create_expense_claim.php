<?php

namespace Fuel\Migrations;

class Create_expense_claim
{
	public function up()
	{
		\DBUtil::create_table('expense_claim', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'credit_account_id' => array('constraint' => 11, 'type' => 'int'),
			'reference' => array('constraint' => 11, 'type' => 'int'),
			'date' => array('type' => 'date'),
			'payer' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'payee' => array('constraint' => 255, 'type' => 'varchar'),
			'gl_account_id' => array('constraint' => 11, 'type' => 'int'),
			'amount' => array('type' => 'decimal'),
			'tax_id' => array('constraint' => 11, 'type' => 'int'),
			'description' => array('constraint' => 255, 'type' => 'varchar'),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
			'deleted_at' => array('type' => 'datetime', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('expense_claim');
	}
}
