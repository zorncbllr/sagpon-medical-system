<?php

use App\Core\Middleware;

class StaffValidator extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$body = [...$request->body];

		$result = new Validator([
			'firstName' => [
				'required' => true,
				'type' => 'string'
			],
			'lastName' => [
				'required' => true,
				'type' => 'string'
			],
			'gender' => [
				'required' => true,
				'type' => 'string'
			],
			'email' => [
				'required' => true,
				'type' => 'email'
			],
			'birthDate' => [
				'required' => true,
				'type' => 'date'
			],
			'address' => [
				'required' => true,
				'type' => 'string'
			],
			'phoneNumber' => [
				'required' => true,
				'type' => 'string'
			],
			'photo' => [
				'required' => true,
				'type' => 'image'
			],
			'shift' => [
				'required' => false,
				'type' => 'string'
			],
			'department' => [
				'required' => true,
				'type' => 'string'
			],
			'position' => [
				'required' => true,
				'type' => 'string'
			]
		], [
			'firstName' => $body['firstName'] ?? '',
			'lastName' => $body['lastName'] ?? '',
			'gender' => $body['gender'] ?? '',
			'email' => $body['email'] ?? '',
			'birthDate' => $body['birthDate'] ?? '',
			'address' => $body['address'] ?? '',
			'phoneNumber' => $body['phoneNumber'] ?? '',
			'photo' => $body['photo'] ?? '',
			'shift' => $body['shift'] ?? '',
			'department' => $body['department'] ?? '',
			'position' => $body['position'] ?? '',
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'message' => 'Unable to register new staff. Make sure to fill all requirements.',
				'errors' => [...$result->getErrors()]
			]);
		}

		foreach ($body as $field => $value) {
			$request->body[$field] = htmlspecialchars($value);
		}

		return $next();
	}
}
