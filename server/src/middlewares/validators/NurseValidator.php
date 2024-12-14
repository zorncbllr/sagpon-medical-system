<?php

use App\Core\Middleware;

class NurseValidator extends Middleware
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
			'licenseNumber' => [
				'required' => true,
				'type' => 'string',
				'length' => [
					'min' => 7,
					'max' => 9
				]
			],
			'shift' => [
				'required' => false,
				'type' => 'string',
			],
			'hospitalAffiliation' => [
				'required' => false,
				'type' => 'string',
			],
			'availability' => [
				'required' => false,
				'type' => 'string'
			],
			'department' => [
				'required' => false,
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
			'licenseNumber' => $body['licenseNumber'] ?? '',
			'shift' => $body['shift'] ?? '',
			'hospitalAffiliation' => $body['hospitalAffiliation'] ?? '',
			'availability' => $body['availability'] ?? '',
			'department' => $body['department'] ?? ''
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'message' => 'Unable to register new nurse. Make sure to fill all requirements.',
				'errors' => [...$result->getErrors()]
			]);
		}

		foreach ($body as $field => $value) {
			$request->body[$field] = htmlspecialchars($value);
		}

		return $next();
	}
}
