<?php

use App\Core\Middleware;

class Authentication extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$headers = getallheaders();
		$token = $headers['Authorization'] ?? '';
		$token = str_replace('Bearer ', '', $token);

		$payload = Token::verify($token, $_ENV['SECRET_KEY']);

		if (!$payload) {
			http_response_code(401);
			return json([
				'msg' => 'Unauthorized access.',
				'route' => '/login'
			]);
		}

		$_SESSION['payload'] = $payload;

		return $next();
	}
}
