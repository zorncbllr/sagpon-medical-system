<?php


class DoctorsService
{
	static function getDoctors(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Doctor');
	}

	static function getDoctorById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Doctor');
	}

	static function registerDoctor(Request $request) {}

	static function updateDoctor(Request $request) {}

	static function deleteDoctor(Request $request)
	{
		return CommonLogic::deleteHandler($request, 'Doctor');
	}
}
