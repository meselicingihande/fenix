<?php

namespace App\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            return redirect('/');
        }

        return $next($request);
    }
}