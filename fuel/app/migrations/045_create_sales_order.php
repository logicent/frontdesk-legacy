<?php

namespace Fuel\Migrations;

class Create_sales_order
{
	public function up()
	{
		\DBUtil::create_table('sales_order', array(
			'id'            => ['constraint' => 11,     'type' => 'int', 'auto_increment' => true, 'unsigned' => true],
			'order_num'   => ['constraint' => 11,     'type' => 'int'],
			'issue_date'    => ['type' => 'date'],
			'due_date'      => ['type' => 'date'],
			'status'        => ['constraint' => 1,      'type' => 'char'],
            // 'source'        => ['constraint' => 140,    'type' => 'varchar'], // Booking or Lease
            // 'source_id'     => ['constraint' => 11,     'type' => 'int'],
            'customer_name' => ['constraint' => 140,    'type' => 'varchar'],
			'unit_name'     => ['constraint' => 140,    'type' => 'varchar'],
			'amount_due'    => ['constraint' => [10,4], 'type' => 'decimal', 'default' => 0.0000],
			'disc_total'    => ['constraint' => [15,4], 'type' => 'decimal', 'default' => 0.0000],
			'tax_total'     => ['constraint' => [15,4], 'type' => 'decimal', 'default' => 0.0000],
			'amount_paid'   => ['constraint' => [15,4], 'type' => 'decimal', 'default' => 0.0000],
			'balance_due'   => ['constraint' => [15,4], 'type' => 'decimal', 'default' => 0.0000],
			'advance_paid'  => ['constraint' => [15,4], 'type' => 'decimal',    'null' => true],
			'paid_status'   => ['constraint' => 2,      'type' => 'char'],
			'po_number'     => ['constraint' => 10,     'type' => 'varchar',    'null' => true],
			'shipping_address'   => ['type' => 'text',                           'null' => true],
			'amounts_tax_inc'   => ['type' => 'tinyint',    'default' => 0,     'null' => true],
			'summary'       => ['constraint' => 140,    'type' => 'varchar',    'null' => true],
			'notes'         => ['type' => 'text',                               'null' => true],
			'fdesk_user'    => ['constraint' => 11,     'type' => 'int'],
			'created_at'    => ['type' => 'datetime'],
			'updated_at'    => ['type' => 'datetime'],
            'deleted_at'    => ['type' => 'datetime',                           'null' => true],
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('sales_order');
	}
}
