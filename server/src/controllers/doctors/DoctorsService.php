<?php

require_once __DIR__ . '/../../utils/Fetcher.php';

class DoctorsService
{
	static function getDoctors(Request $request)
	{
		return Fetcher::fetchAll($request, 'Doctor');
	}

	static function getDoctorById(Request $request)
	{
		return Fetcher::fetchById($request, 'Doctor');
	}

	static function registerDoctor(Request $request) {}

	static function updateDoctor(Request $request) {}

	static function deleteDoctor(Request $request) {}
}
