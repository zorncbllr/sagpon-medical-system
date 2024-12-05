<?php

class Staffs extends Controller
{
	#[Post()]
	public function getStaffs(Request $request)
	{
		return StaffsService::getStaffs($request);
	}

	#[Post('/register')]
	#[Middleware(new StaffValidator)]
	public function registerStaff(Request $request)
	{
		return StaffsService::registerStaff($request);
	}

	#[Post('/:id')]
	public function getStaffById(Request $request)
	{
		return StaffsService::getStaffById($request);
	}

	#[Patch('/update/:id')]
	public function updateStaff(Request $request)
	{
		return StaffsService::updateStaff($request);
	}

	#[Delete('/delete/:id')]
	public function deleteStaff(Request $request)
	{
		return StaffsService::deleteStaff($request);
	}
}
