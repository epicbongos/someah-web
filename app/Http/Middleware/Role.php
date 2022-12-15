<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        $user = Auth::user();
        $accepted = 0;
        foreach ($roles as $role) {
            if ($role == $user->role) {
                $accepted = 1;
            }
        }

        if ($accepted == 1) {
            return $next($request);
        } else {
            return redirect(url('admin/login'));
        }
    }
}
