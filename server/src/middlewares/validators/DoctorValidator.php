<?php

use App\Core\Middleware;

class DoctorValidator extends Middleware
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
			'specialization' => [
				'required' => true,
				'type' => 'string'
			],
			'hospitalAffiliation' => [
				'required' => true,
				'type' => 'string'
			],
			'availability' => [
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
			'specialization' => $body['specialization'] ?? '',
			'hospitalAffiliation' => $body['hospitalAffiliation'] ?? '',
			'availability' => $body['availability'] ?? ''
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'message' => 'Unable to register new doctor. Make sure to fill all requirements.',
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
