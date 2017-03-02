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
		'mapsizeh',
		'mapsizev',
		'title',
		'qlv',
		'qlist',
		'alist',
		'insert_date',
		'update_date',
	);

	protected static $_primary_key = array('code');
	
	protected static $_table_name = 'numberplace_mst';

}
