<?php

use App\Core\Middleware;

class NurseValidator extends Middleware
{
	static function runnable(Request $request, callable $next)
	{
		$result = new Validator([
			
		], []);

	}
}