<?php

use App\Core\Middleware;

class AdminValidator extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$body = $request->body;

		$result = new Validator([
			'firstName' => [
				'required' => true,
				'type' => 'string'
			],
			'middleName' => [
				'required' => true,
				'type' => 'string'
			],
			'lastName' => [
				'required' => true,
				'type' => 'string'
			],
			'phoneNumber' => [
				'required' => true,
				'type' => 'string',
				'length' => [
					'min' => 11,
					'max' => 11
				],
			]
		], [
			'firstName' => $body['firstName'] ?? '',
			'middleName' => $body['middleName'] ?? '',
			'lastName' => $body['lastName'] ?? '',
			'phoneNumber' => $body['phoneNumber'] ?? ''
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'message' => 'Unable to create admin account.',
				'errors' => [...$result->getErrors()]
			]);
		}

		$request->body = array_map(
			fn($field) => htmlspecialchars($field),
			$request->body
		);


		return $next();
	}
}
