<?php

#[Middleware(new Authentication)]
class Home extends Controller
{
	#[Get()]
	public function index(Request $request)
	{
		return json(['msg' => 'Initial set-up done.']);
	}
}
