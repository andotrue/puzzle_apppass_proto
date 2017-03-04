<?php
class Controller_Base extends Controller_Template
{
	public $template = 'layouts/template';
	
	public function before()
	{
		parent::before();

		$this->template->css=array(
			//'bootstrap.min.css',
			//'non-responsive.css',
			'pzl_apppass/use/bootstrap.css',
			'pzl_apppass/use/bootstrap-responsive.css',
			'pzl_apppass/use/common.css',
			'pzl_apppass/base.css',
		);
		$this->template->js=array(
			'jquery-1.8.2.js',
			'bootstrap.min.js',
		);
		
		$this->template->title = "";
		
		//CSSファイル一覧取得
		/*
		$commonCssFiles = \File::read_dir(DOCROOT."assets/css/pzl_apppass/use/", 0, array('\.css$' => 'file'));
		$commonCssFile = '';
		foreach($commonCssFiles as $key => $val)
		{
			$commonCssFile = 'pzl_apppass/use/' . $val;
			array_push(
					$this->template->css
					,$commonCssFile
			);
		}
		*/
		
		//ヘッダー表示
		$this->template->header = \View::forge('layouts/header');
		
		//フッター表示
		$this->template->footer = \View::forge('layouts/footer');
		
		$htmlmeta['description'] = "";
		$htmlmeta['keywords'] = "";
		$this->template->set_global('htmlmeta', $htmlmeta);
	}

	public function after($response){
		return parent::after($response);
	}
}
