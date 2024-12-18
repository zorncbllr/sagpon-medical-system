<?php

use App\Core\Middleware;

class PatientValidator extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$body = [...$request->body];

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
			'email' => [
				'required' => true,
				'type' => 'email'
			],
			'gender' => [
				'required' => true,
				'type' => 'string'
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
				'type' => 'string',
				'length' => [
					'min' => 8,
					'max' => 12
				]
			],
			'photo' => [
				'required' => false,
				'type' => 'image'
			],
			'emergencyContact' => [
				'required' => false,
				'type' => 'string'
			],
			'insuranceProvider' => [
				'required' => false,
				'type' => 'string',
			],
			'policyNumber' => [
				'required' => false,
				'type' => 'string',
				'length' => [
					'min' => 8,
					'max' => 12
				]
			]
		], [
			'firstName' => $body['firstName'] ?? '',
			'middleName' => $body['middleName'] ?? '',
			'lastName' => $body['lastName'] ?? '',
			'gender' => $body['gender'] ?? '',
			'birthDate' => $body['birthDate'] ?? '',
			'address' => $body['address'] ?? '',
			'email' => $body['email'] ?? '',
			'phoneNumber' => $body['phoneNumber'] ?? '',
			'photo' => $body['photo'] ?? '',
			'emergencyContact' => $body['emergencyContact'] ?? '',
			'insuranceProvider' => $body['insuranceProvider'] ?? '',
			'policyNumber' => $body['policyNumber'] ?? ''
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'message' => 'Unable to register new patient. Make sure to fill all requirements.',
				'errors' => [...$result->getErrors()]
			]);
		}

		$request->body = array_map(
			fn($field) => $field ? htmlspecialchars($field) : $field,
			$request->body
		);

		return $next();
	}
}
