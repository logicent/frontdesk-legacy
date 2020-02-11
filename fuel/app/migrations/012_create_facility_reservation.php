<?php

namespace Fuel\Migrations;

class Create_facility_reservation
{
	public function up()
	{
		\DBUtil::create_table('facility_reservation', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'res_no' => array('constraint' => 11, 'type' => 'int'),
			'room_id' => array('constraint' => 11, 'type' => 'int'),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 20, 'type' => 'varchar'),
			'checkin' => array('type' => 'datetime'),
			'checkout' => array('type' => 'datetime'),
			'duration' => array('constraint' => 4, 'type' => 'int'),
			'pax_adults' => array('constraint' => 3, 'type' => 'int', 'default' => 1),
			'pax_children' => array('constraint' => 3, 'type' => 'int', 'default' => 0),
			'pax_infants' => array('constraint' => 3, 'type' => 'int', 'default' => 0),
			'voucher_no' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'last_name' => array('constraint' => 50, 'type' => 'varchar'),
			'first_name' => array('constraint' => 50, 'type' => 'varchar'),
			'address' => array('constraint' => 150, 'type' => 'varchar', 'null' => true),
			'city' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'country' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'email' => array('constraint' => 50, 'type' => 'varchar'),
			'phone' => array('constraint' => 20, 'type' => 'varchar'),
			'rate_type' => array('constraint' => 4, 'type' => 'int'),
			'id_type' => array('constraint' => 3, 'type' => 'char', 'null' => true),
			'id_number' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'id_country' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'remarks' => array('type' => 'text', 'null' => true),
			'created_at' => array('type' => 'date'),
			'updated_at' => array('type' => 'date'),
			'deleted_at' => array('type' => 'datetime', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('facility_reservation');
	}
}
