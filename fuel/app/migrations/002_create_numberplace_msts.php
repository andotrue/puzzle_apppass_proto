<?php

namespace Fuel\Migrations;

class Create_numberplace_msts
{
	public function up()
	{
		\DBUtil::create_table('numberplace_msts', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'code' => array('constraint' => 6, 'type' => 'varchar'),
			'message' => array('constraint' => 256, 'type' => 'varchar'),
			'version' => array('constraint' => 100, 'type' => 'varchar'),
			'puzzleid' => array('constraint' => 11, 'type' => 'int'),
			'questionheaderid' => array('constraint' => 11, 'type' => 'int'),
			'questionbaseurl' => array('constraint' => 255, 'type' => 'varchar'),
			'questionbuttonid' => array('constraint' => 11, 'type' => 'int'),
			'startdt' => array('constraint' => 20, 'type' => 'varchar'),
			'question' => array('constraint' => 11, 'type' => 'int'),
			'mapsizeh' => array('constraint' => 3, 'type' => 'varchar'),
			'mapsizev' => array('constraint' => 3, 'type' => 'varchar'),
			'title' => array('constraint' => 256, 'type' => 'varchar'),
			'qlv' => array('constraint' => 11, 'type' => 'int'),
			'qlist' => array('type' => 'text'),
			'alist' => array('type' => 'text'),
			'insert_date' => array('type' => 'timestamp'),
			'update_date' => array('type' => 'timestamp'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('numberplace_msts');
	}
}