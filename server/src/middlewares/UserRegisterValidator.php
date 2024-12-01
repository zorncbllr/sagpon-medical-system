<?php

use App\Core\Middleware;

class UserRegisterValidator extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$email = $request->body['email'] ?? '';
		$password = $request->body['password'] ?? '';
		$confirmPassword = $request->body['confirmPassword'] ?? '';
		$firstName = $request->body['firstName'] ?? '';
		$lastName = $request->body['lastName'] ?? '';

		$result = new Validator([
			'email' => [
				'required' => true,
				'type' => 'email',
			],
			'password' => [
				'required' => true,
				'type' => 'string',
				'length' => [
					'min' => 8,
					'max' => 100
				]
			],
			'confirmPassword' => [
				'required' => true,
				'type' => 'string',
				'length' => [
					'min' => 8,
					'max' => 100
				]
			],
			'firstName' => [
				'required' => true,
				'type' => 'string',
			],
			'lastName' => [
				'required' => true,
				'type' => 'string'
			]
		], [
			'email' => $email,
			'password' => $password,
			'confirmPassword' => $confirmPassword,
			'firstName' => $firstName,
			'lastName' => $lastName
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'errors' => $result->getErrors()
			]);
		}

		if ($password !== $confirmPassword) {
			http_response_code(400);
			return json([
				'errors' => [
					'confirmPassword' => [
						'Entered password does not match.'
					]
				]
			]);
		}

		foreach ($request->body as $field => $value) {
			$request->body[$field] = htmlspecialchars($value);
		}

		$headers = getallheaders();

		if (isset($headers['Authorization'])) {
			$token = str_replace('Bearer ', '', $headers['Authorization']);
			$payload = Token::verify($token, $_ENV['SECRET_KEY']);

			if ($payload) {
				$_SESSION['role'] = $payload['role'];
			}
		}

		return $next();
	}
}
