<?php

namespace Fuel\Migrations;

class Create_user_tables
{
	public function up()
	{
		\DBUtil::create_table('user_tables', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'platform' => array('constraint' => 30, 'type' => 'varchar'),
			'token' => array('constraint' => 255, 'type' => 'varchar'),
			'account' => array('constraint' => 255, 'type' => 'varchar'),
			'password' => array('constraint' => 64, 'type' => 'varchar'),
			'nickname' => array('constraint' => 255, 'type' => 'varchar'),
			'status' => array('constraint' => 1, 'type' => 'int'),
			'insert_date' => array('type' => 'timestamp'),
			'update_date' => array('type' => 'timestamp'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('user_tables');
	}
}