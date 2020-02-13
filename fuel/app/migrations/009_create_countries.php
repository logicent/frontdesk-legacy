<?php

namespace Fuel\Migrations;

class Create_countries
{
	public function up()
	{
		\DBUtil::create_table('countries', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
            'iso_3166_2' => array('constraint' => 2, 'type' => 'varchar'),
			'iso_3166_3' => array('constraint' => 3, 'type' => 'varchar'),
			'capital' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'citizenship' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'country_code' => array('constraint' => 3, 'type' => 'varchar', 'null' => true),
			'currency' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'currency_code' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'currency_sub_unit' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'currency_symbol' => array('constraint' => 3, 'type' => 'varchar', 'null' => true),
			'currency_decimals' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'full_name' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'region_code' => array('constraint' => 3, 'type' => 'varchar', 'null' => true),
			'sub_region_code' => array('constraint' => 3, 'type' => 'varchar', 'null' => true),
			'eea' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 0),
			'calling_code' => array('constraint' => 3, 'type' => 'varchar', 'null' => true),
			'flag' => array('constraint' => 6, 'type' => 'varchar', 'null' => true),
			'created_at' => array('type' => 'datetime'),
            'updated_at' => array('type' => 'datetime'),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('countries');
	}
}