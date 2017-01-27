<?php

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
	

	public function action_play($puzzleid ,$entry_id="")
	{
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
		
		$query = Model_Crossword_Mst::query()->where('puzzleid', $puzzleid)->order_by('puzzleid', 'desc');
		$crosswordMst = $query->get_one();
		$puzzle = $crosswordMst;
		//echo "<pre>"; var_dump($crosswordMst);echo "</pre>";
		$this->table = new stdClass;
		//exit;


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
		$this->table->auto_heading = false;
		$fullchar = (string)$puzzle->fullchar;
		$answer_cells = explode(' ', (string)$puzzle->aw);
		$table = $row = array();
		$last_cell_no = $pos_x = $pos_y = 0;
		$_hk = explode("\n", trim($puzzle->hk)); $hk = array();
		$_vk = explode("\n", trim($puzzle->vk)); $vk = array();
		for ($i = 0; $i < mb_strlen($fullchar); $i++)
		{
			$cell_no = 0;
			$str = mb_substr($fullchar, $i, 1);
			//$pos_x = count($row);
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
        $view_data['stylesheets'][] = 'crossword';
		$view_data['stylesheets'][] = 'play_result';
        $view_data['stylesheets'][] = 'kb';
		$view_data['javascripts'][] = 'local_history';
		$view_data['javascripts'][] = 'crossword';
		$view_data['javascripts'][] = 'button';
        $view_data['javascripts'][] = 'kb';

        $this->template->content = View::forge('crossword/play',$data);
        
		////$this->load->view('base',$view_data);
        //$this->template->set_global('view_data', $view_data);
	}

}
