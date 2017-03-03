<?php

namespace Fuel\Migrations;

class Create_numberplace_logs
{
	public function up()
	{
		\DBUtil::create_table('numberplace_logs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 256, 'type' => 'varchar'),
			'puzzleid' => array('constraint' => 11, 'type' => 'int'),
			'answer' => array('type' => 'text'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'start_ms' => array('constraint' => 20, 'type' => 'bigint'),
			'finish_ms' => array('constraint' => 20, 'type' => 'bigint'),
			'insert_date' => array('type' => 'timestamp'),
			'update_date' => array('type' => 'timestamp'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('numberplace_logs');
	}
}