<?php

class Model_Crossword_Mst extends \Orm\Model
{
	protected static $_properties = array(
		'code',
		'message',
		'version',
		'puzzleid',
		'questionheaderid',
		'questionbaseurl',
		'questionbuttonid',
		'startdt',
		'question',
		'mapsizeh',
		'mapsizev',
		'title',
		'aw',
		'answerword',
		'fullchar',
		'vk',
		'hk',
		'insert_date',
		'update_date',
	);

	protected static $_primary_key = array('code');

	protected static $_table_name = 'crossword_mst';

}
