<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role == 2) {
            
            return $next($request);
        } elseif ($request->user() && $request->user()->role == 1) {
            // Utilisateur avec le rôle d'utilisateur
            return redirect('dashboard');
        } else {
            // Utilisateur sans rôle spécifié
            return redirect('/')->with('error', 'Vous n\'avez pas les autorisations nécessaires.');
        }
    }
}
