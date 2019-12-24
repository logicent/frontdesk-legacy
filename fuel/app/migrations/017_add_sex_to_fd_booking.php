<?php

namespace Fuel\Migrations;

class Add_sex_to_fd_booking
{
	public function up()
	{
		\DBUtil::add_fields('fd_booking', array(
			'sex' => array('constraint' => 1, 'type' => 'char', 'after' => 'first_name'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('fd_booking', array(
			'sex'

		));
	}
}
