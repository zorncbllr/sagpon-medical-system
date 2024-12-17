<?php


#[Middleware(
	new Authentication,
	new Authorization
)]
class Staffs extends Controller
{
	#[Post()]
	public function getStaffs(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Staff');
	}

	#[Post('/archives')]
	public function getArchives(Request $request)
	{
		return CommonLogic::fetchAll($request, 'ArchivedStaff', isArchived: true);
	}

	#[Post('/register')]
	#[Middleware(new StaffValidator)]
	public function registerStaff(Request $request)
	{
		return CommonLogic::registerHandler($request, 'Staff');
	}

	#[Post('/:staffId')]
	public function getStaffById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Staff');
	}

	#[Post('/archives/:staffId')]
	public function getArchiveByID(Request $request)
	{
		return CommonLogic::fetchById($request, 'ArchivedStaff', isArchived: true);
	}

	#[Patch('/:staffId')]
	public function updateStaff(Request $request)
	{
		return CommonLogic::updateHandler($request, 'Staff');
	}

	#[Delete('/:staffId')]
	public function archiveStaff(Request $request)
	{
		return CommonLogic::archiveHandler($request, 'Staff');
	}

	#[Delete('/archives/:staffId')]
	public function deleteArchiveStaff(Request $request)
	{
		return CommonLogic::deletePermanentHandler($request, 'Staff');
	}
}
