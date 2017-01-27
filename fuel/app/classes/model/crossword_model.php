<?php
class Crossword_model extends CI_Model {
	const TABLE = 'crossword_mst';
	const LOG_TABLE = 'crossword_log';
	const RANK_TABLE = 'crossword_ranking';
    const HIST_TABLE = 'crossword_history';

	var $code = null;
	var $message = null;
	var $version = null;

	var $puzzleid = null;
	var $questionheaderid = null;
	var $questionbaseurl = null;
	var $questionbuttonid = null;
	var $startdt = null;
	var $questionno = null;
	var $mapsizeh = null;
	var $mapsizev = null;
	var $title = null;
	var $aw = null;
	var $answerword = null;
	var $fullchar = null;
	var $vk = null;
	var $hk = null;

	public function __construct()
	{
		parent::__construct();
	}

	public function insert($params, $replace = FALSE)
	{
		$params['update_date'] = date('Y-m-d H:i:s');
		if ($this->_validate($params))
		{
			if ( ! $replace)
			{
				log_message('info', 'sql(insert): --');
				return $this->db->insert(self::TABLE, $params);
			}
			else
			{
				$sql = 'REPLACE INTO ' . self::TABLE
					 . ' (' . implode(', ', array_keys($params)) . ')'
					 . " VALUES ('" . implode("', '", $params) . "')";

				//log_message('info', "sql(replace): {$sql}");
				//return TRUE;
				return $this->db->query($sql);
			}
		}
		log_message('error', 'insert error!!!!!!');

		return FALSE;
	}
	private function _validate($params = null)
	{
		// TODO:
		return TRUE;
	}

	public function find_all()
	{
		return $this->db->select('*')->from(self::TABLE)->order_by('question')->get()->result_array();
	}
    /**
	 * ランキング情報取得
	 */
	public function find_ranking($lv)
	{
        $ranking = $this->db->select('user.user_id,user.nickname,min(rank.score) best_score,
                                    truncate(min(rank.score) /3600000 , 0) hour,
                                    truncate(min(rank.score) %3600000/60000 , 0) minute,
                                    truncate(min(rank.score) %3600000%60000/1000 , 0) second,
                                    truncate(min(rank.score) %3600000%60000%1000 , 0) msecond
                                    ',FALSE)
                ->from(self::RANK_TABLE.' rank')
    			->join('user_table user', "rank.user_id = user.user_id", 'left')
        		->where('rank.level', $lv)->group_by('user_id,nickname')->order_by('best_score')
    			->limit(5)->get()->result_array();

		return $ranking?: false;
	}

    /**
	 * グラフ情報取得
	 */
	public function find_graph($user,$lv)
	{
        $graph_data = $this->db->select('user.user_id,user.nickname,rank.score as best_score,rank.insert_date,
                                    cast(rank.score /60000 as SIGNED) * -1 minute
                                    ',FALSE)
                ->from(self::HIST_TABLE.' rank')
    			->join('user_table user', "rank.user_id = user.user_id", 'left')
        		->where('rank.level', $lv)->where('rank.user_id', $user)->order_by('insert_date desc ')
    			->limit(30)->get()->result_array();
    			//->limit(30)->get()->result_array();

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

	/**
	 * 単一レコード取得
	 *
	 * PRIMARY KEYを指定し特定のレコードを取得する
	 * TODO: 現状puzzleidはPRIMARY KEYじゃないかも？
	 *
	 * @param	int	$id	puzzleid
	 * @return
	 */
	public function find_one($id = null)
	{
		$query = $this->db->get_where(self::TABLE, array('puzzleid' => $id), 1);
		return $query->row()?: false;
	}
	/**
	 * テーブル登録件数取得
	 */
	public function find_all_cnt()
	{
		$cnt = $this->db->from(self::TABLE)
			->count_all_results();
		return $cnt?: false;
	}

	/**
	 * LOG最新1件
	 */
	public function find_one_log($user_id, $puzzleid)
	{
		$query = $this->db->from(self::LOG_TABLE)
			->where(array('user_id' => $user_id, 'puzzleid' => $puzzleid))
			->limit(1)->get();
		return $query->row()?: false;
	}
	/**
	 * 正解件数取得
	 */
	public function find_correct_cnt_log($user_id)
	{
		$cnt = $this->db->from(self::LOG_TABLE)
			->where(array('user_id' => $user_id, 'status' => 9))
			->count_all_results();
		return $cnt?: false;
	}

	/**
	 * ログ挿入
	 *
	 * @return int start_ms
	 */
	public function insert_log($user_id, $puzzleid)
	{
		$ret = false;
		$params = array(
			'user_id'  => $user_id,
			'puzzleid' => $puzzleid,
			'status'   => 0,
			'start_ms' => $this->_get_microtime()
		);
		try
		{
			$ret = $this->db->insert(self::LOG_TABLE, $params);
			if ( ! $ret) throw new Exception(self::LOG_TABLE.' INSERT ERROR');
		}
		catch (Exception $e)
		{
			// TODO:? $this->dbから何が帰ってきたり投げられたりするの?
		}

		return $ret? $params['start_ms'] : false;
	}

	/**
	 * ???
	 *
	 * @return int clear_time
	 */
	public function update_log($user_id, $puzzleid, $answer, $level = 0, $score = 0)
	{
		$ret        = FALSE;
        $high_score = FALSE;
		$params     = array(
			'answer'      => $answer,
			'status'      => 9,
			'finish_ms'   => $this->_get_microtime(),
			'update_date' => date('Y-m-d H:i:s')
		);
		$where  = array('user_id' => $user_id, 'puzzleid' => $puzzleid);
		try
		{
			$ret = $this->db->update(self::LOG_TABLE, $params, $where);
			if ( ! $ret) throw new Exception(self::LOG_TABLE.' UPDATE ERROR');
			$log = $this->find_one_log($user_id, $puzzleid);
			$ret = $log->finish_ms - $log->start_ms;

            if ($score > 0) {
            $params = array(
                'user_id' => $user_id,
                'puzzleid' => $puzzleid,
                'level'    => $level,
                'score'    => $score,
            );
            $this->db->insert(self::HIST_TABLE, $params);
            $rrec = $this->db->get_where(self::RANK_TABLE, $where);
            if ( ! $rrec->num_rows)
            {
                $best = $this->db->select_min('score', 'hs')->from(self::RANK_TABLE)
                    ->where(array('user_id' => $user_id, 'level' => $level))->get()->row();
                if ($best->hs == '' || $best->hs >= $score) $high_score = TRUE;
                $this->db->insert(self::RANK_TABLE, $params);

            }
            }
		}
		catch (Exception $e)
		{
			// UE NI ONAJI
		}

		return array($score, $high_score);
	}

	/*
	 * Ranking
	 */
	public function update_log_ranking($user_id, $puzzleid = 0, $level = 0, $score = 0)
	{
		try
		{
			$where  = array('user_id' => $user_id, 'puzzleid' => $puzzleid);
            $rrec = $this->db->get_where(self::RANK_TABLE, $where);
			if ( ! $rrec->num_rows)
			{
				$params = array(
					'user_id' => $user_id,
					'puzzleid' => $puzzleid,
					'level'    => $level,
					'score'    => $score,
				);
				$this->db->insert(self::RANK_TABLE, $params);

			}
		}
		catch (Exception $e)
		{
			return false;
		}

		return true;
	}

	/**
	 *
	 */
	public function delete_log($user_id, $puzzleid)
	{
		return $this->db->delete(self::LOG_TABLE, array('user_id' => $user_id, 'puzzleid' => $puzzleid));
	}

	private function _get_microtime()
	{
		return floor((float)microtime(TRUE) * 1000);
	}
}
