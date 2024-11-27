<?php

use Firebase\JWT\JWT;

class UsersService
{
	static function loginHandler(Request $request)
	{
		$email = $request->body['email'];
		$password = $request->body['password'];

		$user = User::find(['email' => $email]);

		if (empty($user)) {
			http_response_code(400);
			return json([
				'errors' => [
					'email' => ['User not found.']
				]
			]);
		}

		if (!password_verify($password, $user->getPassword())) {
			http_response_code(400);
			return json([
				'errors' => [
					'password' => ['Wrong credentials.']
				]
			]);
		}

		$payload = [
			'id' => $user->getId(),
			'email' => $user->getEmail(),
			'role' => $user->getRole(),
			'iat' => time(),
			'exp' => time() + 3600 * 24 * 15,
			'nbf' => time(),
			'iss' => 'http://localhost:3000',
			'aud' => 'http://localhost:5173'
		];

		$token = JWT::encode($payload, $_ENV['SECRET_KEY'], 'HS256');

		setcookie('auth_token', $token, [
			'expires' => time() + 3600 * 24 * 15,
			'path' => '/',
			'domain' => 'localhost',
			'secure' => true,
			'httponly' => true,
			'samesite' => 'Lax'
		]);

		http_response_code(200);
		return json([
			'msg' => 'User successfully logged in.',
			'route' => '/dashboard',
			'role' => $user->getRole()
		]);
	}


	static function registerHandler(Request $request)
	{
		$email = $request->body['email'];
		$password = $request->body['password'];
		$firstName = $request->body['firstName'];
		$lastName = $request->body['lastName'];

		$user = new User(
			email: $email,
			password: password_hash($password, PASSWORD_DEFAULT),
			firstName: $firstName,
			lastName: $lastName,
			role: 'patient'
		);

		$isCreated = User::create($user);

		if (!$isCreated) {
			http_response_code(409);
			return json([
				'errors' => [
					'email' => ['User email is already existing.']
				]
			]);
		}

		http_response_code(200);
		return json([
			'msg' => 'New user created successfully.',
			'route' => '/login'
		]);
	}
}
