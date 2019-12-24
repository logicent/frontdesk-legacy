<?php

namespace Fuel\Migrations;

class Create_sales_invoice
{
	public function up()
	{
		\DBUtil::create_table('sales_invoice', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'invoice_num' => array('constraint' => 11, 'type' => 'int'),
			'po_number' => array('constraint' => 10, 'type' => 'varchar'),
			'amounts_tax_inc' => array('type' => 'tinyint'),
			'issue_date' => array('type' => 'date'),
			'due_date' => array('type' => 'date'),
			'status' => array('constraint' => 1, 'type' => 'char'),
			'booking_id' => array('constraint' => 11, 'type' => 'int'),
			'amount_due' => array('constraint' => array(10,4), 'type' => 'decimal'),
			'disc_total' => array('type' => 'decimal'),
			'tax_total' => array('type' => 'decimal'),
			'amount_paid' => array('type' => 'decimal'),
			'balance_due' => array('type' => 'decimal'),
			'advance_paid' => array('type' => 'decimal', 'null' => true),
			'paid_status' => array('constraint' => 2, 'type' => 'char'),
			'billing_address' => array('constraint' => 255, 'type' => 'varchar'),
			'summary' => array('constraint' => 150, 'type' => 'varchar'),
			'notes' => array('constraint' => 255, 'type' => 'varchar'),
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
