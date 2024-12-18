<?php


class Patients extends Controller
{
	#[Post()]
	#[Middleware(new Authentication)]
	public function getPatients(Request $request)
	{
		return PatientsService::getPatients($request);
	}

	#[Post('/archives')]
	#[Middleware(new Authentication)]
	public function getArchives(Request $request) {}

	#[Post('/register')]
	#[Middleware(new PatientValidator)]
	public function registerPatient(Request $request)
	{
		return PatientsService::registerPatient($request);
	}

	#[Post('/:patientId')]
	#[Middleware(new Authentication)]
	public function getPatientById(Request $request)
	{
		return PatientsService::getPatientById($request);
	}

	#[Post('/archives/:patientId')]
	#[Middleware(new Authentication)]
	public function getArchiveById(Request $request) {}

	#[Patch('/:patientId')]
	#[Middleware(new Authentication)]
	public function updatePatient(Request $request) {}

	#[Delete('/:patientId')]
	public function archivePatient(Request $request)
	{
		return PatientsService::archivePatient($request);
	}

	#[Delete('/archives/:patientId')]
	#[Middleware(new Authentication)]
	public function deletePatientArchive(Request $request) {}
}
