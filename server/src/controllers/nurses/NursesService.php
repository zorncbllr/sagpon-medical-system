<?php


class NursesService
{
	static function getNurses(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Nurse');
	}

	static function getNurseById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Nurse');
	}

	static function registerNurse(Request $request) {}

	static function updateNurse(Request $request)
	{
		return  CommonLogic::updateHandler($request, 'Nurse');
	}

	static function deleteNurse(Request $request)
	{
		return CommonLogic::deleteHandler($request, 'Nurse');
	}
}
