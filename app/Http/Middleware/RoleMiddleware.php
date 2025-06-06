<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * $roles bisa string atau array (multi role)
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            // Kalau belum login, redirect ke login
            return redirect()->route('login');
        }

        if (!in_array($user->role, $roles)) {
            // Kalau role user tidak ada di daftar yang diijinkan, misal ke halaman lain atau 403
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
