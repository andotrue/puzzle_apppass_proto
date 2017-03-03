<?php

class Model_Numberplace_Mst extends \Orm\Model
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
		'qlv',//難易度　1,2-星1つ、3-星２つ、4,5-星３つ
		'qlist',
		'alist',
		'insert_date',
		'update_date',
	);

	protected static $_primary_key = array('code');
	
	protected static $_table_name = 'numberplace_mst';

}
