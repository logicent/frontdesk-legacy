<?php

namespace Fuel\Migrations;

class Create_facility_booking
{
	public function up()
	{
		\DBUtil::create_table('facility_booking', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'reg_no' => array('constraint' => 11, 'type' => 'int'),
			'folio_no' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'room_id' => array('constraint' => 11, 'type' => 'int'),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'res_no' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'status' => array('constraint' => 3, 'type' => 'char'),
			'checkin' => array('type' => 'datetime'),
			'checkout' => array('type' => 'datetime'),
			'duration' => array('constraint' => 4, 'type' => 'int', 'default' => 1),
			'pax_adults' => array('constraint' => 3, 'type' => 'int', 'default' => 1),
			'pax_children' => array('constraint' => 3, 'type' => 'int', 'default' => 0),
			'pax_infants' => array('constraint' => 3, 'type' => 'int', 'default' => 0),
			'voucher_no' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'last_name' => array('constraint' => 50, 'type' => 'varchar'),
			'first_name' => array('constraint' => 50, 'type' => 'varchar'),
			'address' => array('constraint' => 150, 'type' => 'varchar', 'null' => true),
			'city' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'country' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'email' => array('constraint' => 50, 'type' => 'varchar', 'null' => true),
			'phone' => array('constraint' => 20, 'type' => 'varchar'),
			'payment_type' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'verify_code' => array('constraint' => 20, 'type' => 'varchar'),
			'card_type' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'card_no' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'card_expire' => array('type' => 'date', 'null' => true),
			'rate_type' => array('constraint' => 4, 'type' => 'int'),
			'rate_amount' => array('type' => 'double', 'default' => 0),
			'vat_amount' => array('type' => 'double', 'default' => 0),
			'total_amount' => array('type' => 'double', 'default' => 0),
			'total_charge' => array('type' => 'double', 'default' => 0),
			'total_payment' => array('type' => 'double', 'default' => 0),
			'id_type' => array('constraint' => 3, 'type' => 'char', 'null' => true),
			'id_number' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'id_country' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'remarks' => array('type' => 'text', 'null' => true),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
			'deleted_at' => array('type' => 'datetime', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('facility_booking');
	}
}
