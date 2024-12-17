<?php

use App\Core\Middleware;

class Authentication extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		try {
			$headers = getallheaders();
			$token = $headers['Authorization'] ?? '';
			$token = str_replace('Bearer ', '', $token);

			$payload = Token::verify($token, $_ENV['SECRET_KEY']);

			if (!$payload) {
				throw new PDOException("Unauthorized Access.", 401);
			}

			$user = User::find(['userId' => $payload->id]);

			if (!$user) {
				throw new PDOException("Access Forbidden.", 403);
			}

			$request->payload = $payload;

			return $next();
		} catch (PDOException $e) {

			$code = $e->getCode();

			if ($code === 401 || $code === 403) {
				http_response_code($code);
				return json([
					'message' => $e->getMessage(),
					'route' => '/login',
					'errors' => [
						'auth_token' => 'Request token was invalid.'
					]
				]);
			}

			http_response_code(500);
			return json([
				'message' => "Internal Server is having a hard time fulfilling request.",
				'errors' => [
					'server' => ["Internal Server is having a hard time fulfilling request."]
				]
			]);
		}
	}
}
