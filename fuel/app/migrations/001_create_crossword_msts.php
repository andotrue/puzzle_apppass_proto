<?php

namespace Fuel\Migrations;

class Create_crossword_msts
{
	public function up()
	{
		\DBUtil::create_table('crossword_mst', array(
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
			'aw' => array('constraint' => 100, 'type' => 'varchar'),
			'answerword' => array('constraint' => 60, 'type' => 'varchar'),
			'fullchar' => array('type' => 'text'),
			'vk' => array('constraint' => 256, 'type' => 'varchar'),
			'hk' => array('constraint' => 256, 'type' => 'varchar'),
			'insert_date' => array('type' => 'timestamp'),
			'update_date' => array('type' => 'timestamp'),

		));
	}

	public function down()
	{
		\DBUtil::drop_table('crossword_mst');
	}
}