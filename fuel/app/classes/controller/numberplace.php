<?php
use Fuel\Core\Log;
use Fuel\Core\DB;

class Controller_Numberplace extends Controller_Base {

	public function bofore()
	{
		//parent::__construct();
		$this->load->model('ModelAuthAuSmartPass', 'asp', TRUE);
		$this->load->model('Auth_model', 'auth', TRUE);
        //if(!$this->auth->isLogin()){
		//	redirect('/auth/login_input', 'location');
        //}
        $this->is_login = $this->auth->isLogin();
        /*
        // au SmartPass Auth
		if(!$this->asp->isMember()){
			$this->session->set_userdata('return_uri', $_SERVER['REQUEST_URI']);
			redirect('/auth/smartpass', 'location');
			exit;
		}
		//
		*/
		$this->load->model('Numberplace_model', 'numberplace', TRUE);
		$auth = $this->session->userdata('auth');
		$this->user_id = $auth['user_id'];
	}

	/*
	 * ゲーム一覧ページ
	 */
	public function action_index()
	{
		redirect('/numberplace/select', 'location');
		exit;
	}

	/*
	 * ゲーム一覧ページ
	 */
	public function action_select($page = 1,$sort = "")
	{
        // 一覧取得
        ////$data = $this->session->userdata('auth');

        //lvsort
        switch ($sort) {
            case 1:
                $sort_var = "case m.qlv when 1 then 1 when 2 then 2 when 3 then 3 when 4 then 4 when 5 then 5 end lvsort";
                break;
            case 2:
                $sort_var = "case m.qlv when 1 then 4 when 2 then 5 when 3 then 1 when 4 then 2 when 5 then 3 end lvsort";
                break;
            case 3:
                $sort_var = "case m.qlv when 1 then 5 when 2 then 4 when 3 then 3 when 4 then 2 when 5 then 1 end lvsort";
                break;
            default:
                $sort_var = "m.question lvsort";
                break;
        }

        $limit = 30;
		////$puzzles = $this->db->select('m.question,m.puzzleid,m.qlv,l.status,'.$sort_var,FALSE)->from('numberplace_mst AS m')
		////	->join('numberplace_log AS l', "l.puzzleid = m.puzzleid AND user_id = '{$data['user_id']}'", 'left')
		////	->where('code', 'INF000')->group_by('title')->order_by('lvsort asc , m.question asc')
		////	->limit($limit + 1, ($page - 1) * $limit)->get()->result_array();

		$puzzles = array();
		$user_id = 1;//kari
		$query = DB::select(DB::expr('m.question, m.puzzleid, m.qlv, l.status, '.$sort_var))->from(DB::expr('numberplace_mst as m'))
		->join(DB::expr('numberplace_log as l'),'LEFT')
		->on('m.puzzleid','=','l.puzzleid')
		->where('user_id','=',$user_id)
		->where('code', 'INF000')
		->group_by('title')
		->order_by(DB::expr('lvsort asc, m.question asc'))
		->limit($limit + 1, ($page - 1) * $limit)
		;
		$puzzles = $query->execute()->as_array();
		
		
        if (count($puzzles) == $limit + 1)
		{
			$data['next'] = $page + 1;
			array_pop($puzzles);
		}
		else
		{
			$data['next'] = FALSE;
		}
		$data['prev'] = ($page > 1)? $page - 1 : FALSE;

		$data["pzs"] = $puzzles;
		$data["sort"] = $sort;

		$graph = array();
        ////$graph["1"] = $this->numberplace->find_graph($data['user_id'],1);
        ////$graph["2"] = $this->numberplace->find_graph($data['user_id'],2);
        ////$graph["3"] = $this->numberplace->find_graph($data['user_id'],3);
		$data["graph"] = $graph;

        ////$view_data["meta"]["title"]  = "ナンプレ問題メニュー";
        ////$view_data["meta"]["keywords"]  = "パズルメイト, パズル, ゲーム, ナンプレ, クロスワード, IQクイズ・パズル, 女子力up, ひらめきup";
        ////$view_data["meta"]["description"]  = "パズル誌発行部数業界No.1の(株)マガジン・マガジンが監修する良質な問題が遊び放題！ナンプレ、クロスワード、IQパズル・クイズ、女子力up、ひらめきupの５つのパズルから好きなゲームを選んでね♪";
		$this->template->title = "ナンプレ問題メニュー";
		$this->template->keywords = "パズルメイト, パズル, ゲーム, ナンプレ, クロスワード, IQクイズ・パズル, 女子力up, ひらめきup";
		$this->template->description = "パズル誌発行部数業界No.1の(株)マガジン・マガジンが監修する良質な問題が遊び放題！ナンプレ、クロスワード、IQパズル・クイズ、女子力up、ひらめきupの５つのパズルから好きなゲームを選んでね♪";
		
        ////$view_data["main_content"]	= $this->load->view('numberplace/select',$data,true);
		////$view_data['top_logo'] = '/img/title_menu.png';
		////$view_data['stylesheets'][] = 'puzzle_menu';
		////$view_data['javascripts'][] = 'puzzle_menu';
		
		//CSSファイルの追加
		$this->template->css = isset($this->template->css)? $this->template->css : array();
		array_push(
				$this->template->css
				,"pzl_apppass/puzzle_menu.css"
		);		

		//JSファイルの追加
		$this->template->js = isset($this->template->js)? $this->template->js : array();
		array_push(
				$this->template->js
				,"pzl_apppass/puzzle_menu.js"
		);
		////$this->load->view('base2',$view_data);
		$this->template->content = View::forge('numberplace/select',$data);
		

	}

	/*
	 * ゲームページ
	 */
	public function action_play($puzzleid ,$entry_id="")
	{
		if($entry_id){
			$this->session->set_userdata('entry', array(
				'puzzle_id' => $puzzleid,
				'entry_id' => $entry_id,
				));
			
		}
		if ( ! $puzzleid)
		{
			// TODO: ID指定ない旨選択画面に渡す
			redirect('/numberplace/select', 'location');
			exit;
		}

		////if ( ! ($puzzle = $this->numberplace->find_one($puzzleid)))
		$puzzle = Model_Numberplace_Mst::find('first', array(
		        'where' => array(
		                array('puzzleid', $puzzleid),
		        )
		));
		if ( ! ($puzzle))
		{
			// TODO: 指定のレコードが存在しない旨選択画面に渡す
			redirect('/numberplace/select', 'location');
			exit;
		}

		$this->is_login = 1;//kari
        if ($this->is_login)
        {
            // 引き継ぎしないままゲームを始めた場合
            ////$auth = $this->session->userdata('auth');
            $user_id = 1;//kari
            $auth = Model_User_Table::find($user_id);
            //echo "<pre>";var_dump($auth);echo "</pre>";
            //echo "<pre>";var_dump($auth['status']);echo "</pre>";
            
            if ($auth['status'] == 2)
            {
                $this->load->model('User_table_model', 'user', TRUE);
                $this->user->seal_succession($this->user_id);
                $auth['status'] = 1;
                $this->session->set_userdata('auth', $auth);
            }
            
		    /////$log = $this->numberplace->find_one_log($this->user_id, $puzzleid);
            $log = DB::select()
                        ->from('numberplace_mst')
                        ->join('numberplace_log')
                        ->on('numberplace_mst.puzzleid','=','numberplace_log.puzzleid')
                        ->where('user_id','=',$user_id)
                        ->where('numberplace_mst.puzzleid', '=', $puzzleid)
                        ->limit(1)->execute()->as_array();
            ;
            //var_dump(DB::last_query());
            //echo "<pre>";var_dump($log);echo "</pre>";
            //exit;
            
		    if (isset($log[0]))
		    {
			    $data['timestamp'] = $log[0]['start_ms'];
		    }
		    else
		    {
			    //$data['timestamp'] = $this->numberplace->insert_log($this->user_id, $puzzleid);
			    $log = new Model_Numberplace_Log();
			    $log->user_id = $user_id;
			    $log->puzzleid = $puzzleid;
			    $log->answer = '';
			    $log->status = 0;
			    $log->start_ms = floor((float)microtime(TRUE) * 1000);
			    $log->finish_ms = 0;
			    $log->save();
			    
			    $data['timestamp'] = floor((float)microtime(TRUE) * 1000);
		    }
        }
        else
        {
            $data['timestamp'] = floor((float)microtime(TRUE) * 1000);
        }
		//$data['timestamp'] = floor((float)microtime(TRUE) * 1000);

		////$this->load->library('table');
		////$this->table->auto_heading = false;
		//$puzzle_data = str_split('013078004600403108800000050100780090209104507040065002090000001301809005400650230');
		$puzzle_data = str_split((string)$puzzle->qlist);
		$table = '<table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table>';
		$table2 = array();
		$row = array();
		foreach ($puzzle_data as $i => $num)
		{
			$cell = (int)$num === 0? array('data' => $table) : array('data' => $num, 'class' => 'fx');
			$row[] = $cell + array('data-col' => ($i%9)+1, 'data-grp' => ($i>=54?6:($i>=27?3:0))+($i%9>=6?3:($i%9>=3?2:1)));
            if (count($row) >= 9)
			{
				////$this->table->add_row($row);
                $table2[] = $row;
			    $row = array();
			}
		}
		$tmpl = array (
			'table_open'	=> '<table id="np">',
			'cell_start'	=> '<td><div class="num">',
			'cell_end'		=> '</div></td>',
			'cell_alt_start'=> '<td><div class="num">',
			'cell_alt_end'	=> '</div></td>',
			'table_close'	=> '</table>'
		);

		////$this->table->set_template($tmpl);
//echo "<pre>"; var_dump($table2);echo "</pre>";
$this->template->set_global('table2', $table2, false);


		$data['entry_id'] = $entry_id;
		$data['puz_id'] = $puzzleid;
		////$data['puzzle'] = $this->table->generate($puzzle_data);
		$data['title']  = 'No.' . $puzzle->question;//$puzzle->title;
        $data['level']  = $puzzle->qlv>=4? 3 : ($puzzle->qlv==3? 2 : 1);

        ////$view_data["meta"]["title"]  = $puzzle->title." ゲーム画面";
        ////$view_data["meta"]["keywords"]  = "パズルメイト, パズル, ゲーム, ナンプレ, クロスワード, IQクイズ・パズル, 女子力up, ひらめきup";
        ////$view_data["meta"]["description"]  = "パズル誌発行部数業界No.1の(株)マガジン・マガジンが監修する良質な問題が遊び放題！答えを入力して、答え合わせボタンを押してください。";
        $this->template->title = $puzzle->title." ゲーム画面";
        $this->template->keywords = "パズルメイト, パズル, ゲーム, ナンプレ, クロスワード, IQクイズ・パズル, 女子力up, ひらめきup";
        $this->template->description = "パズル誌発行部数業界No.1の(株)マガジン・マガジンが監修する良質な問題が遊び放題！答えを入力して、答え合わせボタンを押してください。";
        
        ////$view_data["main_content"]	= $this->load->view('numberplace/play',$data,true);
		////$view_data['stylesheets'][] = 'numberplace';
		////$view_data['stylesheets'][] = 'play_result';
		////$view_data['javascripts'][] = 'numberplace';
		////$view_data['javascripts'][] = 'local_history';
		////$view_data['javascripts'][] = 'play_common';
		////$view_data['javascripts'][] = 'button';
		////$this->load->view('base',$view_data);
		
		//CSSファイルの追加
		$this->template->css = isset($this->template->css)? $this->template->css : array();
		array_push(
		        $this->template->css
		        ,"pzl_apppass/numberplace.css"
		        ,"pzl_apppass/play_result.css"
		        //,"game/kb.css"
		);
		
		//JSファイルの追加
		$this->template->js = isset($this->template->js)? $this->template->js : array();
		array_push(
		        $this->template->js
		        ,"pzl_apppass/button.js"
		        ,"pzl_apppass/numberplace.js"
		        ,"pzl_apppass/local_history.js"
		        ,"pzl_apppass/play_common.js"
		);
		
		
		$this->template->content = View::forge('numberplace/play',$data);
		
	}
	// Game Select
	public function finish($puzzleid)
	{
		if ( ! $puzzleid)
		{
			// ID指定ない旨JSONで返す
			header('Content-type: application/json');
			echo json_encode(array('error' => 'パズルIDが受け取れませんでした'));
			exit;
		}

		if ( ! ($puzzle = $this->numberplace->find_one($puzzleid)))
		{
			// 指定のレコードが存在しないJSONで返す
			header('Content-type: application/json');
			echo json_encode(array('error' => '指定されたレコードが存在しません'));
			exit;
		}

		$return = array();
		$user_answer = (string)$this->input->post('answer');
		$data_answer = (string)$puzzle->alist;
		if ($user_answer == $data_answer) {
            $level = $puzzle->qlv>=4? 3 : ($puzzle->qlv==3? 2 : 1);
            $score = $this->input->post('score')?: 0;
            if ($this->is_login)
            {
			    $result = $this->numberplace->update_log($this->user_id, $puzzleid, $user_answer, $level, $score);
                $h = str_pad(floor($result[0] / (1000 * 60 * 60)),                               2, '0', STR_PAD_LEFT);
                $m = str_pad(floor(($result[0] - $h * 1000 * 60 * 60) / (1000 * 60)),            2, '0', STR_PAD_LEFT);
                $s = str_pad(floor(($result[0] - $h * 1000 * 60 * 60 - $m * 1000 * 60)/ (1000)), 2, '0', STR_PAD_LEFT);
                $return['clear_time'] = $h.':'.$m.':'.$s;;
                $return['high_score'] = $result[1];
            }
            else
            {
                $return['clear_time'] = '00:00:00';
                $return['high_score'] = 0;
            }
			$return['correct'] = true;
		}
		else
		{
			$return['correct'] = false;
		}

		header('Content-type: application/json');
		echo json_encode($return);
		exit;

		$view_data["main_content"]	= $this->load->view('numberplace/finish','',true);
		$this->load->view('base',$view_data);
	}
	
	/*
	 * はじめから
	 */
	public function action_reset($puzzleid)
	{
	    $user_id = 1;//kari
		////$this->numberplace->delete_log($this->user_id, $puzzleid);
		$where = array('user_id'=>$user_id,'puzzleid'=>$puzzleid);
		/*
	    $logs = Model_Numberplace_Log::find('all',array('where'=>$where));
        //echo DB::last_query();
        echo "<pre>";var_dump($logs);echo "</pre>";
	    if($logs){
	        foreach($logs as $log){
                //exit;
	            $log->delete();
	        }
	    }
	    */
	    $result = DB::delete('numberplace_log')->where($where)->execute();;
	    
	    Response::redirect("/numberplace/play/$puzzleid");
	    exit;
	}
	
	/*
	 * 
	 */
	public function reset_entry($puzzleid,$entryid="")
	{
		$this->numberplace->delete_log($this->user_id, $puzzleid);
		redirect('/numberplace/play/' . $puzzleid.'/' . $entryid, 'location');
	}
	//
}
