<?php

use App\Core\Middleware;

class LoginValidator extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$email = $request->body['email'] ?? '';
		$password = $request->body['password'] ?? '';

		$result = new Validator([
			'email' => [
				'required' => true,
				'type' => 'email',
			],
			'password' => [
				'required' => true,
				'type' => 'string'
			]
		], [
			'email' => $email,
			'password' => $password
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'errors' => $result->getErrors()
			]);
		}

		$request->body['email'] = htmlspecialchars($email);
		$request->body['password'] = htmlspecialchars($password);

		return $next();
	}
}
