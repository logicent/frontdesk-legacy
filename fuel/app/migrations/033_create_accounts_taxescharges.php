<?php

namespace Fuel\Migrations;

class Create_accounts_taxescharges
{
	public function up()
	{
		\DBUtil::create_table('accounts_taxescharges', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'code' => array('constraint' => 20, 'type' => 'varchar'),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
			'percentage' => array('type' => 'decimal'),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('accounts_taxescharges');
	}
}