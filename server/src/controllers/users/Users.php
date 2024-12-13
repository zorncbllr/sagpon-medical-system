<?php

class Users extends Controller
{
	#[Post('/login')]
	#[Middleware(new LoginValidator)]
	public function loginHandler(Request $request)
	{
		return UsersService::loginHandler($request);
	}


	#[Post('/register')]
	#[Middleware(new UserRegisterValidator)]
	public function registerHandler(Request $request)
	{
		return UsersService::registerHandler($request);
	}


	#[Patch('/forget-password')]
	#[Middleware(new ForgetPasswordValidator)]
	public function forgotPassword(Request $request)
	{
		return UsersService::forgotPassword($request);
	}


	#[Delete('/:userId')]
	public function deleteUser(Request $request)
	{
		return UsersService::deleteUser($request);
	}


	#[Patch('/:userId')]
	#[Middleware(new UserRegisterValidator)]
	public function updateUser(Request $request)
	{
		return UsersService::updateUser($request);
	}
}
