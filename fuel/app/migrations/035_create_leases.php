<?php

namespace Fuel\Migrations;

class Create_leases
{
	public function up()
	{
		\DBUtil::create_table('leases', array(
            'id'            => array('type' => 'int', 'unsigned' => true, 'auto_increment' => true, 'constraint' => 11),
            'reference'     => array('constraint' => 140, 'type' => 'varchar'),
            'title'         => array('constraint' => 140, 'type' => 'varchar'),
            'customer_id'   => array('constraint' => 11, 'type' => 'int'),
            'status'        => array('constraint' => 140, 'type' => 'varchar'),
            'date_leased'   => array('type' => 'date'),
            'premise_use'   => array('constraint' => 140, 'type' => 'varchar'),
            'lease_period'  => array('constraint' => 11, 'type' => 'int'),
            'billed_period' => array('constraint' => 140, 'type' => 'varchar'),
            'billed_amount' => array('constraint' => '10,2', 'type' => 'decimal'),
            'require_deposit'   => array('type' => 'boolean'),
            'deposit_amount'    => array('constraint' => '10,2', 'type' => 'decimal', 'null' => true),
            'deposit_includes'  => array('null' => true, 'type' => 'text'),
            'start_date'    => array('type' => 'date'),
            'end_date'      => array('type' => 'date'),
            'owner_id'      => array('constraint' => 11, 'type' => 'int'),
            'property_id'   => array('constraint' => 11, 'type' => 'int'),
            'unit_id'       => array('constraint' => 11, 'null' => true, 'type' => 'int'),
            'attachments'   => array('null' => true, 'type' => 'text'),
            'on_hold'       => array('null' => true, 'type' => 'boolean'),
            'on_hold_from'  => array('null' => true, 'type' => 'date'),
            'on_hold_to'    => array('null' => true, 'type' => 'date'),
            'remarks'       => array('null' => true, 'type' => 'text'),
            'fdesk_user'    => array('constraint' => 11, 'type' => 'int'),
            'created_at'    => array('constraint' => 11, 'type' => 'int'),
            'updated_at'    => array('constraint' => 11, 'type' => 'int'),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('leases');
	}
}