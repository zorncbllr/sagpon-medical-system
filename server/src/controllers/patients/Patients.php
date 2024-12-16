<?php

// #[Middleware(
// 	new Authentication,
// 	new Authorization
// )]
class Patients extends Controller
{
	#[Post()]
	public function getPatients(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Patient');
	}

	#[Post('/register')]
	#[Middleware(new PatientValidator)]
	public function registerPatient(Request $request)
	{
		return CommonLogic::registerHandler($request, 'Patient');
	}

	#[Post('/:patientId')]
	public function getPatientById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Patient');
	}

	#[Patch('/:patientId')]
	public function updatePatient(Request $request)
	{
		return CommonLogic::updateHandler($request, 'Patient');
	}

	#[Delete('/:patientId')]
	public function deletePatient(Request $request)
	{
		return CommonLogic::deleteHandler($request, 'Patient');
	}
}
