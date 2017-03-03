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

	/**
	 * グラフ情報取得
	 */
	//public function find_graph($user,$lv)
	public static function find_graph($user_id, $lv)
	{
	    /*
	    $graph_data = $this->db->select('user.user_id,user.nickname,rank.score as best_score,rank.insert_date,
                                    cast(rank.score /60000 as SIGNED) * -1 minute
                                    ',FALSE)
	                                    ->from(self::HIST_TABLE.' rank')
	                                    ->join('user_table user', "rank.user_id = user.user_id", 'left')
	                                    ->where('rank.level', $lv)->where('rank.user_id', $user)->order_by('insert_date desc ')
	                                    ->limit(30)->get()->result_array();
	    //->limit(30)->get()->result_array();
	    */
	    $graph_data = DB::select(DB::expr('
	                       user.user_id,
	                       user.nickname,
	                       rank.score as best_score,
	                       rank.insert_date,
                           cast(rank.score /60000 as SIGNED) * -1 minute
	                   '))
	                   ->from(DB::expr('crossword_history as rank'))
	                   ->join(DB::expr('user_table user'),'LEFT')
	                   ->on('rank.user_id','=','user.user_id')
	                   ->where('rank.level','=',$lv)
	                   ->where('rank.user_id', $user_id)
                	    ->order_by(DB::expr('insert_date desc'))
                	    ->limit(30)
	                   ->execute()->as_array();
	    ;
	    //echo DB::last_query();
	    //echo "<pre>";var_dump($graph_data);echo "</pre>";

	    $tmp_array = array();
	    foreach ($graph_data as $val)
	    {
	        $tmp_array[] = $val["minute"];
	    }
	    for ( $i = count($tmp_array); $i < 30; $i++ )
	    {
	        $tmp_array[] = -60;
	    }
	    krsort($tmp_array);
	    $graph = implode ( "," , $tmp_array);
	    return $graph?: false;
	}
	
}
