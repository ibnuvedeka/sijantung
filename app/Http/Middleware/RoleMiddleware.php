<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah role user SAMA dengan role yang diizinkan (misal: 'developer')
        if (!auth()->check() || auth()->user()->role !== $role) {
            
            // Jika bukan developer, tendang ke menu dashboard (abort 403 juga bisa)
            abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk melihat halaman ini.');
            
        }

        // Jika sesuai, silakan lewat
        return $next($request);
    }
}