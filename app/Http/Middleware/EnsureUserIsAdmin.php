<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Votre logique pour vérifier si l'utilisateur est admin
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            // Redirection si l'utilisateur n'est pas admin
            return redirect('home');
        }

        return $next($request);
    }
}
