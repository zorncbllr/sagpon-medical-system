<?php


class StaffsService
{
	static function getStaffs(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Staff');
	}

	static function getStaffById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Staff');
	}

	static function registerStaff(Request $request) {}

	static function updateStaff(Request $request) {}

	static function deleteStaff(Request $request)
	{
		return CommonLogic::deleteHandler($request, 'Staff');
	}
}
