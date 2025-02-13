<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsClient
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'client') {
            return $next($request); // Autorise l'accès si l'utilisateur est un client
        }

        return redirect('/login')->withErrors('Vous devez être client pour accéder à cette page.');
    }
}

