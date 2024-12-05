<?php

require_once __DIR__ . '/../../utils/Fetcher.php';

class NursesService
{
	static function getNurses(Request $request)
	{
		return Fetcher::fetchAll($request, 'Nurse');
	}

	static function getNurseById(Request $request)
	{
		return Fetcher::fetchById($request, 'Nurse');
	}

	static function registerNurse(Request $request) {}

	static function updateNurse(Request $request) {}

	static function deleteNurse(Request $request) {}
}
