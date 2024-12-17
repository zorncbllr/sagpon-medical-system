<?php


#[Middleware(
	new Authentication,
	new Authorization
)]
class Admins extends Controller
{
	#[Post()]
	public function getAdmins(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Admin');
	}

	#[Post('/register')]
	#[Middleware(new AdminValidator)]
	public function registerAdmin(Request $request)
	{
		return CommonLogic::registerHandler($request, 'Admin');
	}

	#[Post('/:adminId')]
	public function getAdminById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Admin');
	}

	#[Patch('/:adminId')]
	public function updateAdmin(Request $request)
	{
		return CommonLogic::updateHandler($request, 'Admin');
	}

	#[Delete('/:adminId')]
	public function deleteAdmin(Request $request) {}
}
