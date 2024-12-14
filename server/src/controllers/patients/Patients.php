<?php

class Patients extends Controller
{
	#[Post()]
	public function getPatients(Request $request)
	{
		return PatientsService::getPatients($request);
	}

	#[Get('/register')]
	public function registerPatientView(Request $request)
	{
		return view("Patients");
	}

	#[Post('/register')]
	#[Middleware(new PatientValidator)]
	public function registerPatient(Request $request)
	{
		return PatientsService::registerPatient($request);
	}

	#[Post('/:patientId')]
	public function getPatientById(Request $request)
	{
		return PatientsService::getPatientById($request);
	}

	#[Patch('/:patientId')]
	public function updatePatient(Request $request)
	{
		return PatientsService::updatePatient($request);
	}

	#[Delete('/:patientId')]
	public function deletePatient(Request $request)
	{
		return PatientsService::deletePatient($request);
	}
}
