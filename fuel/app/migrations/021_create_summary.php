<?php

namespace Fuel\Migrations;

class Create_summary
{
	public function up()
	{
		\DBUtil::create_table('summary', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'reference' => array('constraint' => 10, 'type' => 'varchar'),
			'date' => array('type' => 'date'),
			'rooms_sold' => array('constraint' => 11, 'type' => 'int'),
			'rooms_blocked' => array('constraint' => 11, 'type' => 'int', 'default' => 0),
			'complimentary_rooms' => array('constraint' => 11, 'type' => 'int', 'default' => 0),
			'no_of_guests' => array('constraint' => 10, 'type' => 'int'),
			'opening_bal' => array('type' => 'decimal'),
			'rent_total' => array('type' => 'decimal'),
			'discount_total' => array('type' => 'decimal'),
			'settlement_total' => array('type' => 'decimal'),
			'expense_total' => array('type' => 'decimal'),
			'deposits_total' => array('type' => 'decimal'),
			'closing_bal' => array('type' => 'decimal'),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'date', 'null' => true),
			'updated_at' => array('type' => 'date', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('summary');
	}
}
