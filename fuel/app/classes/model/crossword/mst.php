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
		'mapsizeh',//縦マス数
		'mapsizev',//横マス数
		'title',
		'aw',
		'answerword',//最終回答
		'fullchar',//各回答 X区切り
		'vk',//縦問題
		'hk',//横問題
		'insert_date',
		'update_date',
	);

	protected static $_primary_key = array('code');

	protected static $_table_name = 'crossword_mst';

}
