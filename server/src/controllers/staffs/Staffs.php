<?php

class Staffs extends Controller
{
	#[Post()]
	public function getStaffs(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Staff');
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

	#[Patch('/:staffId')]
	public function updateStaff(Request $request)
	{
		return CommonLogic::updateHandler($request, 'Staff');
	}

	#[Delete('/:staffId')]
	public function deleteStaff(Request $request)
	{
		return CommonLogic::deleteHandler($request, 'Staff');
	}
}
