<?php

require_once __DIR__ . '/../../utils/Fetcher.php';

class StaffsService
{
	static function getStaffs(Request $request)
	{
		return Fetcher::fetchAll($request, 'Staff');
	}

	static function getStaffById(Request $request)
	{
		return Fetcher::fetchById($request, 'Staff');
	}

	static function registerStaff(Request $request) {}

	static function updateStaff(Request $request) {}

	static function deleteStaff(Request $request) {}
}
