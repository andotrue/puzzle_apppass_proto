<?php

class Model_Numberplace_Log extends \Orm\Model
{
	protected static $_properties = array(
		'user_id',
		'puzzleid',
		'answer',
		'status',//0-、9-クリア
		'start_ms',//中断したときの時間
		'finish_ms',
		'insert_date',
		'update_date',
	);

	protected static $_primary_key = array('user_id');
	
	protected static $_table_name = 'numberplace_log';

}
