<?php


#[Middleware(
	new Authentication,
	new Authorization
)]
class Nurses extends Controller
{
	#[Post()]
	public function getNurses(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Nurse');
	}

	#[Post('/archives')]
	public function getArchives(Request $request)
	{
		return CommonLogic::fetchAll($request, 'ArchivedNurse', isArchived: true);
	}

	#[Post('/register')]
	#[Middleware(new NurseValidator)]
	public function registerNurse(Request $request)
	{
		return CommonLogic::registerHandler($request, 'Nurse');
	}

	#[Post('/:nurseId')]
	public function getNurseById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Nurse');
	}

	#[Post('/archives/:nurseId')]
	public function getArchiveById(Request $request)
	{
		return CommonLogic::fetchById($request, 'ArchivedNurse', isArchived: true);
	}

	#[Patch('/:nurseId')]
	public function updateNurse(Request $request)
	{
		return CommonLogic::updateHandler($request, 'Nurse');
	}

	#[Delete('/:nurseId')]
	public function archiveNurse(Request $request)
	{
		return CommonLogic::archiveHandler($request, 'Nurse');
	}

	#[Delete('/archives/:nurseId')]
	public function deleteArchiveNurse(Request $request)
	{
		return CommonLogic::deletePermanentHandler($request, 'Nurse');
	}
}
