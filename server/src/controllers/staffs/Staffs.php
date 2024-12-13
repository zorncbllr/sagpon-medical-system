<?php

class Staffs extends Controller
{
	#[Post()]
	public function getStaffs(Request $request)
	{
		return StaffsService::getStaffs($request);
	}

	#[Post('/register')]
	#[Middleware(new MedicalPersonValidator)]
	public function registerStaff(Request $request)
	{
		return StaffsService::registerStaff($request);
	}

	#[Post('/:staffId')]
	public function getStaffById(Request $request)
	{
		return StaffsService::getStaffById($request);
	}

	#[Patch('/:staffId')]
	public function updateStaff(Request $request)
	{
		return StaffsService::updateStaff($request);
	}

	#[Delete('/:staffId')]
	public function deleteStaff(Request $request)
	{
		return StaffsService::deleteStaff($request);
	}
}
