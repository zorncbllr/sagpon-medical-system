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
			'shift' => [
				'type' => 'string'
			],
			'department' => [
				'type' => 'string'
			],
			'position' => [
				'type' => 'string'
			],
			'photo' => []
		], [
			'firstName' => $body['firstName'] ?? '',
			'lastName' => $body['lastName'] ?? '',
			'gender' => $body['gender'] ?? '',
			'email' => $body['email'] ?? '',
			'birthDate' => $body['birthDate'] ?? '',
			'address' => $body['address'] ?? '',
			'phoneNumber' => $body['phoneNumber'] ?? '',
			'shift' => $body['shift'] ?? '',
			'department' => $body['department'] ?? '',
			'position' => $body['position'] ?? '',
			'photo' => $body['photo'] ?? ''
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'errors' => [...$result->getErrors()]
			]);
		}

		foreach ($request->body as $field => $value) {
			$request->body[$field] = htmlspecialchars($value);
		}

		return $next();
	}
}
