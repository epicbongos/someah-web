<?php

namespace App\Http\Middleware;

use Closure;

class UserAuth
{
    public function handle($request, Closure $next)
    {
        $checkAuth = Auth::user()->role;

        if($checkAuth == 'admin')
        {
            return 'admin';
        } else{
            return $next($request);
        }

    }
}
