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
            return redirect()->route('loginForm');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            abort(403, 'Not Access'); // or redirect somewhere
        }

        return $next($request);
    }
}
