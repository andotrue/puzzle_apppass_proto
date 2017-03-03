<?php

class Controller_Top extends Controller
{
	public function action_index()
	{
		return Response::forge(View::forge('index'));
	}
	public function action_menu()
	{
	    return Response::forge(View::forge('index'));
	}
	
}
