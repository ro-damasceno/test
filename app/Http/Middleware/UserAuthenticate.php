<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthenticate
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		Auth::shouldUse ('api-users');

		if (!Auth::check ()) {
			return response("Not authorized", 401);
		}

		app ()->singleton ('user', function() {
			return Auth::user ();
		});

		return $next($request);
	}
}