<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and isAdmin is true
        if (Auth::check() && Auth::user()->isAdmin) {
            return $next($request);  // Allow access if isAdmin is true
        }

        return redirect('/')->with('error', 'Unauthorized access. Admins only.');
    }
}
