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
				'type' => 'email',
				'required' => true
			],
			'password' => [
				'type' => 'string',
				'required' => true,
				'length' => [
					'min' => 8,
					'max' => 100
				]
			],
			'confirmPassword' => [
				'type' => 'string',
				'required' => true,
				'length' => [
					'min' => 8,
					'max' => 100
				]
			],
			'firstName' => [
				'type' => 'string',
				'required' => true
			],
			'lastName' => [
				'type' => 'string',
				'required' => true
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
						'Entered password does not match. Please try again.'
					]
				]
			]);
		}

		foreach ($request->body as $field => $value) {
			$request->body[$field] = htmlspecialchars($value);
		}

		return $next();
	}
}
