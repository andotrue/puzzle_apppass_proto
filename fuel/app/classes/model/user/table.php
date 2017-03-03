<?php

class Model_User_Table extends \Orm\Model
{
	protected static $_properties = array(
		'user_id',
		'platform',
		'token',
		'account',
		'password',
		'nickname',
		'status',//0-仮登録、1-登録、2-引き継ぎ
		'insert_date',
		'update_date',
	);

	protected static $_primary_key = array('user_id');

	protected static $_table_name = 'user_table';

}
