<?php


class PatientsService
{
	static function getPatients(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Patient');
	}

	static function getPatientById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Patient');
	}

	static function registerPatient(Request $request) {}

	static function updatePatient(Request $request) {}

	static function deletePatient(Request $request)
	{
		return CommonLogic::deleteHandler($request, 'Patient');
	}
}
