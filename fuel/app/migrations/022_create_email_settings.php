<?php

namespace Fuel\Migrations;

class Create_email_settings
{
	public function up()
	{
		\DBUtil::create_table('email_settings', array(
            'id' => array('type' => 'int', 'unsigned' => true, 'auto_increment' => true, 'constraint' => '11'),
            'from_address' => array('constraint' => '255', 'type' => 'varchar'),
			'from_name' => array('constraint' => '255', 'null' => true, 'type' => 'varchar'),
			'smtp_host' => array('constraint' => '255', 'type' => 'varchar'),
			'smtp_username' => array('constraint' => '255', 'type' => 'varchar'),
			'smtp_password' => array('constraint' => '255', 'type' => 'varchar'),
			'smtp_port' => array('constraint' => '11', 'type' => 'int'),
			'smtp_starttls' => array('null' => true, 'type' => 'boolean'),
			'smtp_timeout' => array('constraint' => '11', 'null' => true, 'type' => 'int'),
			'created_at' => array('constraint' => '11', 'type' => 'int'),
			'updated_at' => array('constraint' => '11', 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('email_settings');
	}
}