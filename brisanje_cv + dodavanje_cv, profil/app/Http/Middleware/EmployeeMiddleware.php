<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must be logged in.');
        }

        // Ensure user has 'employee' status
        if (Auth::user()->status !== 'employee') {
            return redirect('/')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
