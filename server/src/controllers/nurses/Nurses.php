<?php

#[Middleware(
	new Authentication,
	new Authorization
)]
class Nurses extends Controller
{
	#[Post()]
	public function getNurses(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Nurse');
	}

	#[Post('/register')]
	#[Middleware(new NurseValidator)]
	public function registerNurse(Request $request)
	{
		return CommonLogic::registerHandler($request, 'Nurse');
	}

	#[Post('/:nurseId')]
	public function getNurseById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Nurse');
	}

	#[Patch('/:nurseId')]
	public function updateNurse(Request $request)
	{
		return CommonLogic::updateHandler($request, 'Nurse');
	}

	#[Delete('/:nurseId')]
	public function deleteNurse(Request $request)
	{
		return CommonLogic::deleteHandler($request, 'Nurse');
	}
}
