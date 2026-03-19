<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * $role = expected role (admin or client)
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            //  → redirect login
            return redirect()->route('loginForm');
        }

        $user = Auth::user();


        if ($user->role !== $role) {
            // unauthorized
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
