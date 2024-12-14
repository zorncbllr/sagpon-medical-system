<?php

use App\Core\Middleware;

class Authorization extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$role = $_SESSION['payload']->role;
		$baseRoute = explode('/', $request->uri)[1];

		if (!str_contains($baseRoute, $role) || $role !== 'admin') {
			http_response_code(403);
			return json([
				'message' => 'Unauthorized access to forbidden route.',
			]);
		}

		return $next();
	}
}
