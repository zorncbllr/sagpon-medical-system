<?php

use App\Core\Middleware;

class NurseValidator extends Middleware
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
			'shift' => [
				'type' => 'string'
			],
			'hospitalAffiliation' => [
				'type' => 'string'
			],
			'availability' => [
				'type' => 'string'
			],
			'department' => [
				'type' => 'string'
			]
		], [
			'licenseNumber' => $body['licenseNumber'] ?? '',
			'shift' => $body['shift'] ?? '',
			'hospitalAffiliation' => $body['hospitalAffiliation'] ?? '',
			'availability' => $body['availability'] ?? '',
			'department' => $body['department'] ?? ''
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
