<?php

class Nurses extends Controller
{
	#[Post()]
	public function getNurses(Request $request)
	{
		return NursesService::getNurses($request);
	}

	#[Post('/register')]
	#[Middleware(new NurseValidator)]
	public function registerNurse(Request $request)
	{
		return NursesService::registerNurse($request);
	}

	#[Post('/:nurseId')]
	public function getNurseById(Request $request)
	{
		return NursesService::getNurseById($request);
	}

	#[Patch('/:nurseId')]
	public function updateNurse(Request $request)
	{
		return NursesService::updateNurse($request);
	}

	#[Delete('/:nurseId')]
	public function deleteNurse(Request $request)
	{
		return NursesService::deleteNurse($request);
	}
}
