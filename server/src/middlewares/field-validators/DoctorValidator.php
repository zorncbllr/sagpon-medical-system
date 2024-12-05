<?php

use App\Core\Middleware;

class DoctorValidator extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$body = [...$request->body];

		$result = new Validator([
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
			'licenseNumber' => $body['licenseNumber'] ?? '',
			'specialization' => $body['specialization'] ?? '',
			'hospitalAffiliation' => $body['hospitalAffiliation'] ?? '',
			'availability' => $body['availability'] ?? ''
		]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'errors' => [...$result->getErrors()]
			]);
		}

		foreach ($body as $field => $value) {
			$request->body[$field] = htmlspecialchars($value);
		}

		return $next();
	}
}
