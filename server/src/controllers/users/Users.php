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

	
}
