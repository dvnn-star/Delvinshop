<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {   
             if (!auth()->check() || auth()->user()->role !== $role) {
            // kalau user bukan role yang diminta, tendang ke home
            return redirect()->route('home');
        }
        return $next($request);
    }
}
