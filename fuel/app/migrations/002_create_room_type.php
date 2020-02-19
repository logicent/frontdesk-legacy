<?php

namespace Fuel\Migrations;

class Create_room_type
{
	public function up()
	{
        //  facility unity type
		\DBUtil::create_table('room_type', [
			'id'            => ['type' => 'int',        'constraint' => 11,     'auto_increment' => true, 'unsigned' => true],
			'code'          => ['type' => 'varchar',    'constraint' => 20, ],
			'name'          => ['type' => 'varchar',    'constraint' => 140, ],
            'description'   => ['type' => 'text',                               'null' => true],
			'alias'         => ['type' => 'varchar',    'constraint' => 140,    'null' => true], // Room | Bed | Site | Suite | Apartment 
            'base_rate'     => ['type' => 'decimal',                            'default' => 0.00], // use in costing a sale
            'is_rental'     => ['type' => 'tinyint',    'constraint' => 1,      'default' => 0],
            'inactive'      => ['type' => 'tinyint',                            'null' => true, 'default' => 0],
            'ota_mappings'  => ['type' => 'text',                               'null' => true],
            'amenities'     => ['type' => 'text',                               'null' => true],
            'image_path'    => ['type' => 'varchar',    'constraint' => 140,    'null' => true],
			'fdesk_user'    => ['type' => 'int',        'constraint' => 11],
			'max_persons'   => ['type' => 'int',        'constraint' => 11],
			'default_pax'   => ['type' => 'int',        'constraint' => 11],
			'created_at'    => ['type' => 'datetime'],
			'updated_at'    => ['type' => 'datetime'],
            'deleted_at'    => ['type' => 'datetime',                           'null' => true],
            
		], ['id']);
	}

	public function down()
	{
		\DBUtil::drop_table('room_type');
	}
}