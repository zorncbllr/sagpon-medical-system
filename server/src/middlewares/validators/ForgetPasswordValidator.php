<?php

use App\Core\Middleware;

class ForgetPasswordValidator extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$email = $request->body['email'] ?? '';
		$newPassword = $request->body['newPassword'] ?? '';
		$confirmPassword = $request->body['confirmPassword'] ?? '';

		$result = new Validator([
			'email' => [
				'required' => true,
				'type' => 'email'
			],
			'newPassword' => [
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
			]
		], [
			'email' => $email,
			'newPassword' => $newPassword,
			'confirmPassword' => $confirmPassword
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'errors' => $result->getErrors()
			]);
		}

		if ($newPassword !== $confirmPassword) {
			http_response_code(400);
			return json([
				'errors' => [
					'confirmPassword' => ['Entered password does not match.']
				]
			]);
		}

		$request->body = array_map(
			fn($field) => htmlspecialchars($field),
			$request->body
		);

		return $next();
	}
}
