<?php

class Nurses extends Controller
{
	#[Post()]
	public function getNurses(Request $request)
	{
		return NursesService::getNurses($request);
	}

	#[Post('/:id')]
	public function getNurseById(Request $request)
	{
		return NursesService::getNurseById($request);
	}

	#[Post('/register')]
	public function registerNurse(Request $request)
	{
		return NursesService::registerNurse($request);
	}

	#[Patch('/update/:id')]
	public function updateNurse(Request $request)
	{
		return NursesService::updateNurse($request);
	}

	#[Delete('/delete/:id')]
	public function deleteNurse(Request $request)
	{
		return NursesService::deleteNurse($request);
	}
}
