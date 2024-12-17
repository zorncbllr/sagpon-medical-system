<?php


#[Middleware(
	new Authentication,
	new Authorization
)]
class Doctors extends Controller
{
	#[Post()]
	public function getDoctors(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Doctor');
	}

	#[Post('/archives')]
	public function getArchives(Request $request)
	{
		return CommonLogic::fetchAll($request, 'ArchivedDoctor', isArchived: true);
	}

	#[Post('/register')]
	#[Middleware(new DoctorValidator)]
	public function registerDoctor(Request $request)
	{
		return CommonLogic::registerHandler($request, 'Doctor');
	}

	#[Post('/:doctorId')]
	public function getDoctorById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Doctor');
	}

	#[Post('/archives/:doctorId')]
	public function getArchiveById(Request $request)
	{
		return CommonLogic::fetchById($request, 'ArchivedDoctor', isArchived: true);
	}

	#[Patch('/:doctorId')]
	public function updateDoctor(Request $request)
	{
		return CommonLogic::updateHandler($request, 'Doctor');
	}

	#[Delete('/:doctorId')]
	public function archiveDoctor(Request $request)
	{
		return CommonLogic::archiveHandler($request, 'Doctor');
	}

	#[Delete('/archives/:doctorId')]
	public function deleteDoctorArchive(Request $request)
	{
		return CommonLogic::deletePermanentHandler($request, 'Doctor');
	}
}
