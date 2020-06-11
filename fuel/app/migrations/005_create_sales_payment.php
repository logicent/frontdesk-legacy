<?php

namespace Fuel\Migrations;

class Create_sales_payment
{
	public function up()
	{
		\DBUtil::create_table('sales_payment', [
			'id'				=> ['constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true],
			'date' 				=> ['type' => 'date'],
			'amount' 			=> ['type' => 'decimal'],
			'gl_account_id' 	=> ['constraint' => 11, 	'type' => 'int', 'null' => true],
			'currency' 			=> ['constraint' => 3, 		'type' => 'char'],
			'description' 		=> ['constraint' => 140, 	'type' => 'varchar', 'null' => true],
            'payment_method' 	=> ['constraint' => 140, 	'type' => 'varchar'],
			'reference'			=> ['constraint' => 140, 	'type' => 'varchar', 'null' => true],
			'receipt_number' 	=> ['constraint' => 11, 	'type' => 'int'],
            'source'        	=> ['constraint' => 140,    'type' => 'varchar'], // Booking or Lease
			'source_id'     	=> ['constraint' => 11,     'type' => 'int'],
            // 'customer_name' 	=> ['constraint' => 140,    'type' => 'varchar'],
            'payer' 			=> ['constraint' => 140, 	'type' => 'varchar', 'null' => true],
            'attachment' 		=> ['constraint' => 140, 	'type' => 'varchar', 'null' => true],
            'status' 			=> ['constraint' => 140, 	'type' => 'varchar', 'null' => true],
			'tax_id' 			=> ['constraint' => 11, 	'type' => 'int', 	'null' => true],
			'bank_account_id' 	=> ['constraint' => 11, 	'type' => 'int', 	'null' => true],
			'fdesk_user' 		=> ['constraint' => 11, 	'type' => 'int'],
			'created_at' 		=> ['type' => 'datetime'],
			'updated_at' 		=> ['type' => 'datetime'],
			'deleted_at' 		=> ['type' => 'datetime', 'null' => true],
		], ['id']);
	}

	public function down()
	{
		\DBUtil::drop_table('sales_payment');
	}
}
