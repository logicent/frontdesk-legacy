<?php

namespace Fuel\Migrations;

class Add_services_to_business
{
	public function up()
	{
		\DBUtil::add_fields('business', array(
			'service_accommodation' => array('null' => true, 'type' => 'boolean', 'after' => 'business_type'), // tinyint
			'service_rental' => array('null' => true, 'type' => 'boolean', 'after' => 'service_accommodation'),
			'service_hire' => array('null' => true, 'type' => 'boolean', 'after' => 'service_rental'),
			'service_sale' => array('null' => true, 'type' => 'boolean', 'after' => 'service_hire'),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('business', array(
			'service_accommodation'
,			'service_rental'
,			'service_hire'
,			'service_sale'
		));
	}
}