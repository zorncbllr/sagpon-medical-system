<?php

class Users extends Controller
{
	#[Route(path: '/login', method: 'POST')]
	#[Middleware(new LoginValidator)]
	public function loginHandler(Request $request)
	{
		return UsersService::loginHandler($request);
	}

	#[Route(path: '/register', method: 'POST')]
	#[Middleware(new UserRegisterValidator)]
	public function registerHandler(Request $request)
	{
		return UsersService::registerHandler($request);
	}


	#[Route(path: '/forget-password', method: 'PATCH')]
	#[Middleware(new ForgetPasswordValidator)]
	public function forgotPassword(Request $request)
	{
		return UsersService::forgotPassword($request);
	}


	#[Route(path: '/delete/:id', method: 'DELETE')]
	public function deleteUser(Request $request)
	{
		return UsersService::deleteUser($request);
	}


	#[Route(path: '/update/:id', method: 'PUT')]
	#[Middleware(new UserRegisterValidator)]
	public function updateUser(Request $request)
	{
		return UsersService::updateUser($request);
	}
}
