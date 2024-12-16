<?php

class Rooms extends Controller 
{
	#[Get()]
	public function index(Request $request){
		return 'Rooms controller';
	}
}
