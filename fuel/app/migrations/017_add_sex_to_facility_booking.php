<?php

namespace Fuel\Migrations;

class Add_sex_to_facility_booking
{
	public function up()
	{
		\DBUtil::add_fields('facility_booking', array(
			'sex' => array('constraint' => 1, 'type' => 'char', 'after' => 'first_name'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('facility_booking', array(
			'sex'

		));
	}
}
