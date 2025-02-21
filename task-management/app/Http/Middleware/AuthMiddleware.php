<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // User is not authenticated, redirect to login page
            return redirect()->route('welcome');
        }

        // User is authenticated, proceed with the request
        return $next($request);
    }
}
