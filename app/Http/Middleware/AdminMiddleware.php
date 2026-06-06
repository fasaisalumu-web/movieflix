<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Angalia kama user amelogin NA ni admin
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        // Akisi admin, rudisha nyumbani na ujumbe wa error
        return redirect()->route('movies.index')->with('error', 'Access Denied. Admins only.');
    }
}