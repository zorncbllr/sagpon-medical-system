<?php

require_once __DIR__ . '/../../utils/Fetcher.php';

class PatientsService
{
	static function getPatients(Request $request)
	{
		return Fetcher::fetchAll($request, 'Patient');
	}

	static function getPatientById(Request $request)
	{
		return Fetcher::fetchById($request, 'Patient');
	}

	static function registerPatient(Request $request) {}

	static function updatePatient(Request $request) {}

	static function deletePatient(Request $request) {}
}
