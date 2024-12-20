<?php


class Patients extends Controller
{
	#[Post()]
	#[Middleware(new Authentication)]
	public function getPatients(Request $request)
	{
		return PatientsService::getPatients($request);
	}

	#[Post('/register')]
	#[Middleware(new PatientValidator)]
	public function registerPatient(Request $request)
	{
		return PatientsService::registerPatient($request);
	}

	#[Post('/download')]
	public function downloadData(Request $request)
	{
		return PatientsService::downloadData($request);
	}

	#[Post('/:patientId')]
	#[Middleware(new Authentication)]
	public function getPatientById(Request $request)
	{
		return PatientsService::getPatientById($request);
	}

	#[Patch('/:patientId')]
	#[Middleware(new Authentication)]
	public function updatePatient(Request $request)
	{
		return PatientsService::updatePatient($request);
	}

	#[Delete('/:patientId')]
	public function archivePatient(Request $request)
	{
		return PatientsService::archivePatient($request);
	}
}
