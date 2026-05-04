<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // សំខាន់៖ ត្រូវតែមានដើម្បីប្រើ Auth

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // ១. ពិនិត្យការ Login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // ២. ពិនិត្យ Role (ប្រៀបធៀបតម្លៃក្នុង Database ជាមួយ $role មកពី Route)
        if (Auth::user()->role !== $role) {
            return redirect('/')->with('error', 'អ្នកមិនមានសិទ្ធិចូលទៅកាន់ផ្នែកនេះទេ!');
        }

        return $next($request);
    }
}
