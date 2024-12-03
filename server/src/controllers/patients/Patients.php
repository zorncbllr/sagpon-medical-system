<?php

class Patients extends Controller
{
	#[Post()]
	public function getPatients(Request $request)
	{
		return PatientsService::getPatients($request);
	}

	#[Post('/:id')]
	public function getPatientById(Request $request)
	{
		return PatientsService::getPatientById($request);
	}

	#[Post('/register')]
	public function registerPatient(Request $request)
	{
		return PatientsService::registerPatient($request);
	}

	#[Patch('/update/:id')]
	public function updatePatient(Request $request)
	{
		return PatientsService::updatePatient($request);
	}

	#[Delete('/delete/:id')]
	public function deletePatient(Request $request)
	{
		return PatientsService::deletePatient($request);
	}
}
