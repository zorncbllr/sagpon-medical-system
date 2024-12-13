<?php

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
			'id' => $user->getUserId(),
			'email' => $user->getEmail(),
			'role' => $user->getRole(),
		];

		$token = Token::sign($payload, $_ENV['SECRET_KEY'], 3600 * 24 * 15);

		http_response_code(200);
		return json([
			'msg' => 'User successfully logged in.',
			'route' => '/dashboard',
			'token' => $token,
			'role' => $user->getRole()
		]);
	}


	static function registerHandler(Request $request)
	{
		$data = [
			...$request->body,
			"password" => password_hash($request->body['password'], PASSWORD_DEFAULT),
			"role" => "patient"
		];

		$user = new User(...$data);

		$isCreated = $user->save();

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


	static function forgotPassword(Request $request)
	{
		$email = $request->body['email'];
		$newPassword = $request->body['newPassword'];

		$user = User::find(['email' => $email]);

		if (!$user) {
			http_response_code(400);
			return json([
				'errors' => [
					'email' => ['User not found.']
				]
			]);
		}

		$user->setPassword(
			password_hash($newPassword, PASSWORD_DEFAULT)
		);

		$isUpdated = $user->update();

		if (!$isUpdated) {
			http_response_code(400);
			return json([
				'msg' => 'Unable to update password.',
				'errors' => []
			]);
		}

		http_response_code(200);
		return json([
			'msg' => 'Password successfully updated.',
			'route' => '/login'
		]);
	}


	static function deleteUser(Request $request)
	{
		$id = htmlspecialchars($request->param['userId']);

		$user = User::find(['userId' => $id]);

		if (!$user) {
			http_response_code(400);
			return json([
				'msg' => 'User not found.'
			]);
		}

		$isDeleted = $user->delete();

		if (!$isDeleted) {
			http_response_code(500);
			return json([
				'msg' => 'Unable to delete user.'
			]);
		}

		http_response_code(200);
		return json([
			'msg' => 'User successfuly deleted.'
		]);
	}

	static function updateUser(Request $request)
	{
		$id = htmlspecialchars($request->param['userId']);

		$user = User::find(['userId' => $id]);

		if (!$user) {
			http_response_code(400);
			return json([
				'msg' => 'User not found.'
			]);
		}

		$data = [
			...$request->body,
			'password' => password_hash(
				$request->body['password'],
				PASSWORD_DEFAULT
			)
		];

		$isUpdated = $user->update(...$data);

		if (!$isUpdated) {
			http_response_code(409);
			return json([
				'errors' => [
					'email' => ['Duplicated email.']
				]
			]);
		}

		http_response_code(200);
		return json([
			'msg' => 'User updated successfully.'
		]);
	}
}
