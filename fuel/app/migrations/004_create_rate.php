<?php

namespace Fuel\Migrations;

class Create_rate
{
	public function up()
	{
		\DBUtil::create_table('rate', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'rate_id' => array('constraint' => 11, 'type' => 'int'),
			'type_id' => array('constraint' => 11, 'type' => 'int'),
			'description' => array('type' => 'text', 'null' => true),
            'amount' => array('type' => 'decimal', 'default' => 0.00), // i.e. standard rate
			'charges' => array('type' => 'decimal', 'default' => 0.00), // i.e. tax amount
            'is_tax_incl' => array('type' => 'tinyint', 'default' => 0),
            'is_seasonal_rate' => array('type' => 'tinyint', 'default' => 0),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rate');
	}
}