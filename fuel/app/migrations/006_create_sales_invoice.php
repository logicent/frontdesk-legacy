<?php

namespace Fuel\Migrations;

class Create_sales_invoice
{
	public function up()
	{
		\DBUtil::create_table('sales_invoice', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'invoice_num' => array('constraint' => 11, 'type' => 'int'),
			'issue_date' => array('type' => 'date'),
			'due_date' => array('type' => 'date'),
			'status' => array('constraint' => 1, 'type' => 'char'),
			'booking_id' => array('constraint' => 11, 'type' => 'int'),
			'amount_due' => array('constraint' => array(10,4), 'type' => 'decimal', 'default' => 0.0000),
			'disc_total' => array('constraint' => array(15,4), 'type' => 'decimal', 'default' => 0.0000),
			'tax_total' => array('constraint' => array(15,4), 'type' => 'decimal', 'default' => 0.0000),
			'amount_paid' => array('constraint' => array(15,4), 'type' => 'decimal', 'default' => 0.0000),
			'balance_due' => array('constraint' => array(15,4), 'type' => 'decimal', 'default' => 0.0000),
			'advance_paid' => array('constraint' => array(15,4), 'type' => 'decimal', 'null' => true),
			'paid_status' => array('constraint' => 2, 'type' => 'char'),
			'billing_address' => array('type' => 'text', 'null' => true),
			'po_number' => array('constraint' => 10, 'type' => 'varchar', 'null' => true),
			'amounts_tax_inc' => array('type' => 'tinyint', 'default' => 0),
			'summary' => array('constraint' => 140, 'type' => 'varchar', 'null' => true),
			'notes' => array('type' => 'text', 'null' => true),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),			
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
			'deleted_at' => array('type' => 'datetime'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('sales_invoice');
	}
}
