<?php

namespace Fuel\Migrations;

class Create_unit_type
{
	public function up()
	{
		\DBUtil::create_table('unit_type', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'code' => array('constraint' => 20, 'type' => 'varchar'), // abbrev or acronym
			'property_id' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 140, 'type' => 'varchar'),
            'description' => array('type' => 'text', 'null' => true),
			'alias' => array('constraint' => 140, 'type' => 'varchar', 'null' => true), // e.g. Room | Bed | Site | Suite | Apartment 
            'base_rate' => array('type' => 'decimal', 'default' => 0.00), // use in costing a sale
            'used_for' => array('constraint' => 3, 'type' => 'char'),
            'inactive' => array('type' => 'tinyint', 'null' => true, 'default' => 0),
            'ota_mappings' => array('type' => 'text', 'null' => true),
            'amenities' => array('type' => 'text', 'null' => true),
            'image_path' => array('constraint' => 140, 'type' => 'varchar', 'null' => true),
			'fdesk_user' => array('constraint' => 11, 'type' => 'int'),
			'max_persons' => array('constraint' => 11, 'type' => 'int'),
			'default_pax' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
            'deleted_at' => array('type' => 'datetime', 'null' => true),
            
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('unit_type');
	}
}