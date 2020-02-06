<?php

namespace Fuel\Migrations;

class Create_task_checklists
{
	public function up()
	{
		\DBUtil::create_table('task_checklists', array(
            'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
            'heading' => array('type' => 'text'),
			'content' => array('type' => 'text'),            
			'created_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
			'updated_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('task_checklists');
	}
}