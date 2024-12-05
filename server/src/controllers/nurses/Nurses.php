<?php

class Nurses extends Controller
{
	#[Post()]
	public function getNurses(Request $request)
	{
		return NursesService::getNurses($request);
	}

	#[Post('/register')]
	#[Middleware(
		new MedicalPersonValidator,
		new NurseValidator
	)]
	public function registerNurse(Request $request)
	{
		return NursesService::registerNurse($request);
	}

	#[Post('/:id')]
	public function getNurseById(Request $request)
	{
		return NursesService::getNurseById($request);
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
