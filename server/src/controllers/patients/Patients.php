<?php


class Patients extends Controller
{
	#[Post()]
	#[Middleware(new Authentication)]
	public function getPatients(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Patient');
	}

	#[Post('/archives')]
	#[Middleware(new Authentication)]
	public function getArchives(Request $request)
	{
		return CommonLogic::fetchAll($request, 'ArchivedPatient', isArchived: true);
	}

	#[Post('/register')]
	#[Middleware(new PatientValidator)]
	public function registerPatient(Request $request)
	{
		return CommonLogic::registerHandler($request, 'Patient');
	}

	#[Post('/:patientId')]
	#[Middleware(new Authentication)]
	public function getPatientById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Patient');
	}

	#[Post('/archives/:patientId')]
	#[Middleware(new Authentication)]
	public function getArchiveById(Request $request)
	{
		return CommonLogic::fetchById($request, 'ArchivedPatient');
	}

	#[Patch('/:patientId')]
	#[Middleware(new Authentication)]
	public function updatePatient(Request $request)
	{
		return CommonLogic::updateHandler($request, 'Patient');
	}

	#[Delete('/:patientId')]
	public function archivePatient(Request $request)
	{
		return CommonLogic::archiveHandler($request, 'Patient');
	}

	#[Delete('/archives/:patientId')]
	#[Middleware(new Authentication)]
	public function deletePatientArchive(Request $request)
	{
		return CommonLogic::deletePermanentHandler($request, 'Patient');
	}
}
