<?php
use Fuel\Core\Log;
use Fuel\Core\DB;

class Controller_Crossword extends Controller_Base
{	
	public function bofore()
	{
		//parent::__construct();
		$this->load->model('ModelAuthAuSmartPass', 'asp', TRUE);
		$this->load->model('Auth_model', 'auth', TRUE);
        $this->is_login = $this->auth->isLogin();
		// au SmartPass Auth
		/*
		if(!$this->asp->isMember()){
			$this->session->set_userdata('return_uri', $_SERVER['REQUEST_URI']);
			redirect('/auth/smartpass', 'location');
			exit;
		}
		*/
		$this->load->model('Crossword_model', 'crossword', TRUE);
		$auth = $this->session->userdata('auth');
		$this->user_id = $auth['user_id'];
	}
	
	/*
	 * クロスワード一覧画面
	 */
	public function action_select($page = 1,$sort ="")
	{
		////$this->load->model('Crossword_model', 'crossword', TRUE);
		// 一覧取得
		////$data = $this->session->userdata('auth');
		$data = array();
	
		//lvsort
		switch ($sort) {
			case 1:
				$sort_var = "case m.mapsizeh when 5 then 1 when 6 then 2 when 7 then 3 when 8 then 4 end lvsort";
				break;
			case 2:
				$sort_var = "case m.mapsizeh when 5 then 4 when 6 then 1 when 7 then 2 when 8 then 3 end lvsort";
				break;
			case 3:
				$sort_var = "case m.mapsizeh when 5 then 4 when 6 then 3 when 7 then 2 when 8 then 1 end lvsort";
				break;
			default:
				$sort_var = "m.question lvsort";
				break;
		}
	
		$limit = 30;
		////$puzzles = $this->db->select('m.question,m.puzzleid,m.mapsizeh,l.status,'.$sort_var,FALSE)->from('crossword_mst AS m')
		////->join('crossword_log AS l', "l.puzzleid = m.puzzleid AND user_id = '{$data['user_id']}'", 'left')
		////->where('code', 'INF000')->group_by('title')->order_by('lvsort asc , m.question asc')
		////->limit($limit + 1, ($page - 1) * $limit)->get()->result_array();
		
		$puzzles = array();
		$user_id = 1;//kari
		echo $sort_var."/";
        $query = DB::select(DB::expr('m.question,m.puzzleid,m.mapsizeh,l.status,'.$sort_var))->from(DB::expr('crossword_mst as m'))
                    ->join(DB::expr('crossword_log as l'),'LEFT')
                    ->on('m.puzzleid','=','l.puzzleid')
                    ->where('user_id','=',$user_id)
                    ->where('code', 'INF000')
                    ->group_by('title')
                    ->order_by(DB::expr('lvsort asc, m.question asc'))
                    ->limit($limit + 1, ($page - 1) * $limit)
                    ;
        $puzzles = $query->execute()->as_array();
        
        //Log::debug(print_r(DB::last_query(),true));
        //echo DB::last_query();exit;
        //Log::debug(print_r($puzzles,true));
        
		
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
		////log_message('error', "message");
		////log_message('error', "message0");
	
		$data["pzs"] = $puzzles;
		$data["sort"] = $sort;
		////$graph["1"] = $this->crossword->find_graph($data['user_id'],1);
		////$graph["2"] = $this->crossword->find_graph($data['user_id'],2);
		////$graph["3"] = $this->crossword->find_graph($data['user_id'],3);
		$graph = array();
		$data["graph"] = $graph;
	
		$view_data["meta"]["title"]  = "クロスワード問題メニュー";
		$view_data["meta"]["keywords"]  = "パズルメイト, パズル, ゲーム, ナンプレ, クロスワード, IQクイズ・パズル, 女子力up, ひらめきup";
		$view_data["meta"]["description"]  = "パズル誌発行部数業界No.1の(株)マガジン・マガジンが監修する良質な問題が遊び放題！ナンプレ、クロスワード、IQパズル・クイズ、女子力up、ひらめきupの５つのパズルから好きなゲームを選んでね♪";
	
		////$view_data["main_content"]	= $this->load->view('crossword/select',$data,true);
		$view_data['top_logo'] = '/img/title_menu.png';
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
		$this->template->content = View::forge('crossword/select',$data);
	}
	
	/*
	 * クロスワードゲーム画面表示
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
			redirect('/crossword/select', 'location');
			exit;
		}
		
		/*////ORIGINAL CI
		if ( ! ($puzzle = $this->crossword->find_one($puzzleid)))
		{
			// TODO: 指定のレコードが存在しない旨選択画面に渡す
			redirect('/crossword/select', 'location');
			exit;
		}
		*/
		
		//$query = Model_Crossword_Mst::query()->where('puzzleid', $puzzleid)->order_by('puzzleid', 'desc');
		//$crosswordMst = $query->get_one();
		//$puzzle = $crosswordMst;
		$puzzle = Model_Crossword_Mst::find('first', array(
				'where' => array(
						array('puzzleid', $puzzleid),
				)
		));
//echo "<pre>"; var_dump($puzzle);echo "</pre>";
//echo "<pre>"; var_dump($crosswordMst);echo "</pre>";
		////$this->table = new stdClass;

		/*////
        if ($this->is_login)
        {
            // 引き継ぎしないままゲームを始めた場合
            $auth = $this->session->userdata('auth');
            if ($auth['status'] == 2)
            {
                $this->load->model('User_table_model', 'user', TRUE);
                $this->user->seal_succession($this->user_id);
                $auth['status'] = 1;
                $this->session->set_userdata('auth', $auth);
            }

		    if ($log = $this->crossword->find_one_log($this->user_id, $puzzleid))
		    {
			    $data['timestamp'] = $log->start_ms;
		    }
		    else
		    {
			    $data['timestamp'] = $this->crossword->insert_log($this->user_id, $puzzleid);
		    }
        }
        else
        {
            $data['timestamp'] = floor((float)microtime(TRUE) * 1000);
        }
        */

		////$this->load->library('table');////HTML テーブルクラス クラスの初期化
		////$this->table->auto_heading = false;
		$fullchar = (string)$puzzle->fullchar;
		$answer_cells = explode(' ', (string)$puzzle->aw);
		////$table = $row = array();
		$table = array();
		$last_cell_no = $pos_x = $pos_y = 0;
		$_hk = explode("\n", trim($puzzle->hk)); $hk = array();
		$_vk = explode("\n", trim($puzzle->vk)); $vk = array();
//echo "<pre>"; var_dump($_hk);echo "</pre>"; 
//echo "<pre>"; var_dump($fullchar);echo "</pre>";
		for ($i = 0; $i < mb_strlen($fullchar); $i++)
		{
			$cell_no = 0;
			$str = mb_substr($fullchar, $i, 1);
			//$pos_x = count($row);
//echo "<pre>"; var_dump($str);echo "</pre>";
			$pos_y = count($table);
			if ($str !== 'X')
			{
				$u_str = $pos_y>0? mb_substr($fullchar, $i-$puzzle->mapsizeh, 1) : FALSE;
				$l_str = $pos_x>0? mb_substr($fullchar, $i-1, 1) : FALSE;
				$r_str = $pos_x<$puzzle->mapsizeh-1? mb_substr($fullchar, $i+1, 1) : FALSE;
				$b_str = $pos_y<$puzzle->mapsizev? mb_substr($fullchar, $i+$puzzle->mapsizev, 1) : FALSE;
				//echo $i.'-'.$pos_x.'-'.$pos_y.':'.$str.':'.$u_str.':'.$l_str.':'.$r_str.':'.$b_str.'<br>';
				// 下端じゃなく 上端か上が黒マスで 下が空いてる
				if ($b_str && $b_str !== 'X' && ( ! $u_str OR $u_str === 'X'))
				{
					$cell_no = ++$last_cell_no;
					$vk[$last_cell_no] = array_shift($_vk);
					if ($r_str && $r_str !== 'X' && ( ! $l_str OR $l_str === 'X'))
					{
						$hk[$last_cell_no] = array_shift($_hk);
					}
				}
				// 右端じゃなく 左端か左が黒マスで 右が空いてる
				elseif ($r_str && $r_str !== 'X' && ( ! $l_str OR $l_str === 'X'))
				{
					$cell_no = ++$last_cell_no;
					$hk[$last_cell_no] = array_shift($_hk);
				}
			}
			$row[] = $str==='X'
				? array('data' => '&nbsp;', 'class'  => 'black')
				: array(
					'data' => ($cell_no? '<div class="cell-no" data-cell-no="'.$cell_no.'">'.$cell_no.'</div>' : '') .
							  (in_array($i+1, $answer_cells)? '<div class="ans-no" name="'.($acn=array_search($i+1, $answer_cells)+1).'">'.$acn.'</div>' : '').
							  '<input type="text" maxlength="1" autocorrect="off" name="cells[]" />',
					'class' => in_array($i+1, $answer_cells)? 'ans' : ''
				);
			if (count($row) >= $puzzle->mapsizeh)
			{
				/////$this->table->add_row($row);
				$table[] = $row;
				$row = array();
				$pos_x = 0;
			}
			else $pos_x++;
		}
		////$tmpl = array('table_open' => '<table id="cw">');
		////$this->table->set_template($tmpl);
//echo "<pre>"; var_dump($hk);echo "</pre>";
//echo "<pre>"; var_dump($table);echo "</pre>";
//$data['table'] = $table;
$this->template->set_global('table', $table, false);	
		

		$data['entry_id'] = $entry_id;
		$data['puz_id'] = $puzzleid;
		////$data['puzzle'] = $this->table->generate($puzzle_data);///回答マステーブルHTMLテーブルタグ
		$data['title']  = 'No.' . $puzzle->question;//$puzzle->title;
		$data['hk'] = $hk;//nl2br($puzzle->hk);
		$data['vk'] = $vk;//nl2br($puzzle->vk);
		$data['timestamp'] = floor(microtime(TRUE) * 1000);
        $data['level'] = $puzzle->mapsizeh>=8? 3 : ($puzzle->mapsizeh>=6? 2 : 1);
        $data['answer_cells'] = $answer_cells;

        $view_data["meta"]["title"]  = $puzzle->title." ゲーム画面";
        $view_data["meta"]["keywords"]  = "パズルメイト, パズル, ゲーム, ナンプレ, クロスワード, IQクイズ・パズル, 女子力up, ひらめきup";
        $view_data["meta"]["description"]  = "パズル誌発行部数業界No.1の(株)マガジン・マガジンが監修する良質な問題が遊び放題！答えを入力して、答え合わせボタンを押してください。";

        ////$view_data["main_content"]	= $this->load->view('crossword/play',$data,true);
        ////$view_data['stylesheets'][] = 'crossword';
		////$view_data['stylesheets'][] = 'play_result';
        ////$view_data['stylesheets'][] = 'kb';
		////$view_data['javascripts'][] = 'local_history';
		////$view_data['javascripts'][] = 'crossword';
		////$view_data['javascripts'][] = 'button';
        ////$view_data['javascripts'][] = 'kb';
        //CSSファイルの追加
        $this->template->css = isset($this->template->css)? $this->template->css : array();
        array_push(
        		$this->template->css
        		,"game/crossword.css"
        		,"game/play_result.css"
        		,"game/kb.css"
        );
        
        //JSファイルの追加
        $this->template->js = isset($this->template->js)? $this->template->js : array();
        array_push(
        		$this->template->js
        		,"game/button.js"
        		,"game/crossword.js"
        		,"game/kb.js"
        		,"game/local_history.js"
        );
        

        $this->template->content = View::forge('crossword/play',$data);
        
		////$this->load->view('base',$view_data);
	}

	/*
	 * 答え合わせ
	 */
	public function action_finish($puzzleid)
	{
		Log::debug("action_finish");
		Log::debug("puzzleid:$puzzleid");
		
		if (!$puzzleid)
		{
			// ID指定ない旨JSONで返す
			header('Content-type: application/json');
			echo json_encode(array('error' => 'パズルIDが受け取れませんでした'));
			exit;
		}
	
		//if ( ! ($puzzle = $this->crossword->find_one($puzzleid)))
		$puzzle = Model_Crossword_Mst::find('first', array(
				'where' => array(
						array('puzzleid', $puzzleid),
				)
		));
		
		//Log::debug(DB::last_query());
		//Log::debug(print_r($puzzle,true));
		if (!$puzzle)
		{
			// 指定のレコードが存在しないJSONで返す
			header('Content-type: application/json');
			echo json_encode(array('error' => '指定されたレコードが存在しません'));
			exit;
		}
		Log::debug(print_r("answerword:".$puzzle->answerword,true));
		$answer = (Input::param("answer")) ? Input::param("answer") : "";
		Log::debug(print_r("answer:".$answer,true));
		
		
		$return = array();
		////$user_answer = mb_convert_kana($this->input->post('answer'), 'ASKCV', 'UTF-8');
		$user_answer = $answer;
		$data_answer = mb_convert_kana($puzzle->answerword, 'ASKCV', 'UTF-8');
		if ($user_answer == $data_answer) {
			$level = $puzzle->mapsizeh>=8? 3 : ($puzzle->mapsizeh>=6? 2 : 1);
			$score = $this->input->post('score')?: 0;
			if ($this->is_login)
			{
				$result = $this->crossword->update_log($this->user_id, $puzzleid, $user_answer, $level, $score);
				$h = str_pad(floor($result[0] / (1000 * 60 * 60)),                               2, '0', STR_PAD_LEFT);
				$m = str_pad(floor(($result[0] - $h * 1000 * 60 * 60) / (1000 * 60)),            2, '0', STR_PAD_LEFT);
				$s = str_pad(floor(($result[0] - $h * 1000 * 60 * 60 - $m * 1000 * 60)/ (1000)), 2, '0', STR_PAD_LEFT);
				$return['clear_time'] = $h.':'.$m.':'.$s;
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
	
		$view_data["main_content"]	= $this->load->view('crossword/finish','',true);
		$this->load->view('base',$view_data);
	}
	public function action_reset($puzzleid)
	{
		$this->crossword->delete_log($this->user_id, $puzzleid);
		redirect('/crossword/play/' . $puzzleid, 'location');
	}
	public function action_reset_entry($puzzleid,$entryid="")
	{
		$this->numberplace->delete_log($this->user_id, $puzzleid);
		redirect('/crossword/play/' . $puzzleid.'/' . $entryid, 'location');
	}
	//
	
}
