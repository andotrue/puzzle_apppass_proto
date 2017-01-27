<?php

class Controller_Index extends Controller
{
	public function action_index()
	{
		return Response::forge(View::forge('index'));
	}

}
