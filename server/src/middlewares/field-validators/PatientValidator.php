<?php

use App\Core\Middleware;

class PatientValidator extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$body = [...$request->body];

		$result = new Validator([
			'emergencyContact' => [
				'type' => 'string'
			],
			'insuranceProvider' => [
				'type' => 'string'
			],
			'policyNumber' => [
				'type' => 'string',
			]
		], [
			'emergencyContact' => $body['emergencyContact'] ?? '',
			'insuranceProvider' => $body['insuranceProvider'] ?? '',
			'policyNumber' => $body['policyNumber'] ?? ''
		]);

		foreach ($body as $field => $value) {
			$request->body[$field] = htmlspecialchars($value);
		}

		return $next();
	}
}
