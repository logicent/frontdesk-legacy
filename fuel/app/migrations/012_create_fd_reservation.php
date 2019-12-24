<?php

namespace Fuel\Migrations;

class Create_fd_reservation
{
	public function up()
	{
		\DBUtil::create_table('fd_reservation', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'res_no' => array('constraint' => 11, 'type' => 'int'),
			'room_id' => array('constraint' => 11, 'type' => 'int'),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 6, 'type' => 'varchar'),
			'checkin' => array('type' => 'datetime'),
			'checkout' => array('type' => 'datetime'),
			'duration' => array('constraint' => 4, 'type' => 'int'),
			'pax_adults' => array('constraint' => 3, 'type' => 'int'),
			'pax_children' => array('constraint' => 3, 'type' => 'int'),
			'voucher_no' => array('constraint' => 11, 'type' => 'int'),
			'last_name' => array('constraint' => 50, 'type' => 'varchar'),
			'first_name' => array('constraint' => 50, 'type' => 'varchar'),
			'address' => array('constraint' => 150, 'type' => 'varchar'),
			'city' => array('constraint' => 20, 'type' => 'varchar'),
			'country' => array('constraint' => 11, 'type' => 'int'),
			'email' => array('constraint' => 50, 'type' => 'varchar'),
			'phone' => array('constraint' => 20, 'type' => 'varchar'),
			'rate_type' => array('constraint' => 4, 'type' => 'int'),
			'id_type' => array('constraint' => 3, 'type' => 'char'),
			'id_number' => array('constraint' => 20, 'type' => 'varchar'),
			'id_country' => array('constraint' => 11, 'type' => 'int'),
			'remarks' => array('type' => 'text'),
			'created_at' => array('type' => 'date'),
			'updated_at' => array('type' => 'date'),
			'deleted_at' => array('type' => 'datetime', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('fd_reservation');
	}
}
