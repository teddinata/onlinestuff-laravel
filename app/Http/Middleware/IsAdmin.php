<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->roles == 'admin') {
            return $next($request);
        }

        // return view abort(403);
        // return redirect('/');
        // abort(403);
        // after 5s redirect to home
        return redirect('/')->with('error', 'You are not allowed to access this page');
    }
}
