<?php

namespace Fuel\Migrations;

class Create_facility_booking
{
	public function up()
	{
		\DBUtil::create_table('facility_booking', [
			'id'            => ['type' => 'int',     'constraint' => 11,    'auto_increment' => true, 'unsigned' => true],
			'reg_no'        => ['type' => 'int',     'constraint' => 11],
			'folio_no'      => ['type' => 'int',     'constraint' => 11,    'null' => true],
			'customer_id'   => ['type' => 'int',     'constraint' => 11],
			'unit_id'       => ['type' => 'int',     'constraint' => 11],
			'fdesk_user'    => ['type' => 'int',     'constraint' => 11],
			'res_no'        => ['type' => 'int',     'constraint' => 11,    'null' => true],
			'status'        => ['type' => 'char',    'constraint' => 3],
			'checkin'       => ['type' => 'datetime'],
			'checkout'      => ['type' => 'datetime'],
			'duration'      => ['type' => 'int',     'constraint' => 4,     'default' => 1],
			'pax_adults'    => ['type' => 'int',     'constraint' => 3,     'default' => 1],
			'pax_children'  => ['type' => 'int',     'constraint' => 3,     'default' => 0],
			'pax_infants'   => ['type' => 'int',     'constraint' => 3,     'default' => 0],
			'voucher_no'    => ['type' => 'int',     'constraint' => 11,    'null' => true],
			'customer_name' => ['type' => 'varchar', 'constraint' => 140,   'null' => true],
			'address'       => ['type' => 'varchar', 'constraint' => 140,   'null' => true],
			'city'          => ['type' => 'varchar', 'constraint' => 20,    'null' => true],
			'country'       => ['type' => 'int',     'constraint' => 11,    'null' => true],
			'email'         => ['type' => 'varchar', 'constraint' => 140,   'null' => true],
			'phone'         => ['type' => 'varchar', 'constraint' => 140], 
			'payment_type'  => ['type' => 'varchar', 'constraint' => 20,    'null' => true],
			'verify_code'   => ['type' => 'varchar', 'constraint' => 20,    'null' => true],
			'card_type'     => ['type' => 'varchar', 'constraint' => 20,    'null' => true],
			'card_no'       => ['type' => 'varchar', 'constraint' => 20,    'null' => true],
			'card_expire'   => ['type' => 'date',                           'null' => true],
			'rate_type'     => ['type' => 'int',     'constraint' => 4],
			'rate_amount'   => ['type' => 'decimal',                        'default' => 0.00],
			'vat_amount'    => ['type' => 'decimal',                        'default' => 0.00],
			'total_amount'  => ['type' => 'decimal',                        'default' => 0.00],
			'total_charge'  => ['type' => 'decimal',                        'default' => 0.00],
			'total_payment' => ['type' => 'decimal',                        'default' => 0.00],
			'ID_type'       => ['type' => 'char',    'constraint' => 3],
			'ID_number'     => ['type' => 'varchar', 'constraint' => 20],
			'ID_country'    => ['type' => 'char',    'constraint' => 3],
			'remarks'       => ['type' => 'text',                           'null' => true],
			'created_at'    => ['type' => 'datetime'],
			'updated_at'    => ['type' => 'datetime'],
            'deleted_at'    => ['type' => 'datetime',                       'null' => true],

		], ['id']);
	}

	public function down()
	{
		\DBUtil::drop_table('facility_booking');
	}
}
