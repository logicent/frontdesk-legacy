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
            'billing_period' => array('constraint' => 140, 'type' => 'varchar'),
            'applicable_tax' => array('type' => 'text', 'null' => true),
            'channels' => array('type' => 'text', 'null' => true),
            'is_tax_incl' => array('type' => 'tinyint', 'default' => 0),
            'inactive' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 0),
            'rate_group' => array('type' => 'varchar', 'default' => 'Standard'),
            'valid_from' => array('type' => 'date', 'null' => true),
            'valid_until' => array('type' => 'date', 'null' => true),
            'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
            'deleted_at' => array('type' => 'datetime', 'null' => true),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rate');
	}
}