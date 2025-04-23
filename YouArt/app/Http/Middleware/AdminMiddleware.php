<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        
        // Redirect to home if not admin
        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
}
