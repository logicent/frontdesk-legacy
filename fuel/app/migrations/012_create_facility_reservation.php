<?php

namespace Fuel\Migrations;

class Create_facility_reservation
{
	public function up()
	{
		\DBUtil::create_table('facility_reservation', array(
			'id'         => ['constraint' => 11,    'type' => 'int', 'auto_increment' => true, 'unsigned' => true],
            'res_no'     => ['constraint' => 11,    'type' => 'int'],
			'customer_id'=> ['constraint' => 11,    'type' => 'int'],
			'unit_id'    => ['constraint' => 11,    'type' => 'int'],
			'fdesk_user' => ['constraint' => 11,    'type' => 'int'],
			'status'     => ['constraint' => 20,    'type' => 'varchar'],
			'checkin'    => ['type' => 'datetime'],
			'checkout'   => ['type' => 'datetime'],
			'duration'   => ['constraint' => 4,     'type' => 'int'],
			'pax_adults' => ['constraint' => 3,     'type' => 'int',        'default' => 1],
			'pax_children'  => ['constraint' => 3,  'type' => 'int',        'default' => 0],
			'pax_infants'=> ['constraint' => 3,     'type' => 'int',        'default' => 0],
			'voucher_no' => ['constraint' => 11,    'type' => 'int',        'null' => true],
			'customer_name' => ['constraint' => 140,   'type' => 'varchar', 'null' => true],
			'address'    => ['constraint' => 140,   'type' => 'varchar',    'null' => true],
			'city'       => ['constraint' => 140,   'type' => 'varchar',    'null' => true],
			'country'    => ['constraint' => 3,     'type' => 'char',       'null' => true],
			'email'      => ['constraint' => 140,   'type' => 'varchar'],
			'phone'      => ['constraint' => 140,   'type' => 'varchar'],
			'rate_type'  => ['constraint' => 4,     'type' => 'int'],
			'ID_type'    => ['constraint' => 3,     'type' => 'char'],
			'ID_number'  => ['constraint' => 20,    'type' => 'varchar'],
			'ID_country' => ['constraint' => 3,     'type' => 'char'],
			'remarks'    => ['type' => 'text',                              'null' => true],
			'created_at' => ['type' => 'datetime'],
			'updated_at' => ['type' => 'datetime'],
			'deleted_at' => ['type' => 'datetime',                          'null' => true],

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('facility_reservation');
	}
}
