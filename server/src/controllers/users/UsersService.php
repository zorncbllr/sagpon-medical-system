<?php

use Ramsey\Uuid\Uuid;

class UsersService
{
	static function loginHandler(Request $request)
	{
		try {
			$email = $request->body['email'];
			$password = $request->body['password'];

			$user = User::find(['email' => $email]);

			if (!$user) {
				throw new PDOException("User does not exist.", 404);
			}

			if (!password_verify($password, $user->getPassword())) {
				throw new PDOException("Wrong credentials.", 401);
			}

			$payload = [
				'id' => $user->getUserId(),
				'email' => $user->getEmail(),
				'role' => $user->getRole(),
			];

			$token = Token::sign($payload, $_ENV['SECRET_KEY'], 3600 * 24 * 15);

			http_response_code(200);
			return json([
				'message' => 'Log in successful.',
				'route' => '/dashboard',
				'token' => $token,
				'role' => $user->getRole(),
			]);
		} catch (PDOException $e) {

			if ($e->getCode() === 404) {
				http_response_code(404);
				return json([
					'messsage' => $e->getMessage(),
					'errors' => [
						'email' => [$e->getMessage()]
					]
				]);
			}

			if ($e->getCode() === 401) {
				http_response_code(401);
				return json([
					'message' => $e->getMessage(),
					'errors' => [
						'password' => [$e->getMessage()]
					]
				]);
			}

			http_response_code(500);
			return json([
				'message' => "Internal Server is having a hard time fulfilling login request.",
				'errors' => [
					'server' => ["Internal Server is having a hard time fulfilling login request."]
				]
			]);
		}
	}


	static function registerHandler(Request $request)
	{
		try {
			$body = [...$request->body];
			$email = $body['email'];
			$password = $body['password'];

			$user = User::find(['email' => $email]);

			if ($user) {
				throw new PDOException("Email is already taken", 409);
			}

			$role = 'patient';
			$payload = $request->payload;

			if ($payload && $payload->role === 'admin') {
				$role = $body['role'];
			}

			$uuid = Uuid::uuid4()->toString();

			$user = new User(
				userId: $uuid,
				email: $email,
				password: password_hash($password, PASSWORD_DEFAULT),
				role: $role
			);

			$user->save();

			http_response_code(201);
			return json([
				'message' => 'New user has been registered.',
				'route' => '/dashboard'
			]);
		} catch (PDOException $e) {

			if ($e->getCode() === 409) {
				http_response_code(409);
				return json([
					'message' => $e->getMessage(),
					'errors' => [
						'email' => [$e->getMessage()]
					]
				]);
			}

			http_response_code(500);
			return json([
				'message' => "Internal Server is having a hard time fulfilling request.",
				'errors' => [
					'server' => ["Internal Server is having a hard time fulfilling request."]
				]
			]);
		}
	}


	static function forgotPassword(Request $request)
	{
		try {
			$email = $request->body['email'];
			$newPassword = $request->body['newPassword'];

			$user = User::find(['email' => $email]);

			if (!$user) {
				throw new PDOException("User with email {$email} does not exist.", 404);
			}

			$user->setPassword(
				password_hash($newPassword, PASSWORD_DEFAULT)
			);

			$user->update();

			http_response_code(201);
			return json([
				'message' => 'Password successfully updated.',
				'route' => '/login',
			]);
		} catch (PDOException $e) {

			if ($e->getCode() == 404) {
				http_response_code($e->getCode());
				return json([
					'errors' => [
						'email' => $e->getMessage()
					]
				]);
			}

			http_response_code(500);
			return json([
				'message' => "Internal Server is having a hard time fulfilling forget-password request.",
				'errors' => [
					'server' => ["Internal Server is having a hard time fulfilling forget-password request."]
				]
			]);
		}
	}


	static function deleteUser(Request $request)
	{
		try {
			$id = $request->param['id'];

			$user = User::find(['userId' => $id]);

			if (!$user) {
				throw new PDOException("User with userId {$id} not found.", 404);
			}

			$user->delete();

			http_response_code(205);
			return json([
				'message' => 'User was successfully deleted.'
			]);
		} catch (PDOException $e) {

			if ($e->getCode() === 404) {
				http_response_code(404);
				return json([
					'message' => $e->getMessage(),
					'errors' => [
						'userId' => [$e->getMessage()]
					]
				]);
			}
		}
	}


	static function updateUser(Request $request) {
		
	}
}
