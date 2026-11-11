<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Ubah role user di database menjadi huruf kecil semua untuk dicocokkan
        $userRole = strtolower($user->role);
        
        // Ubah semua parameter role yang dikirim dari route menjadi huruf kecil
        $allowedRoles = array_map('strtolower', $roles);

        // Jika role user ada di dalam list yang diizinkan, lanjutkan
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        // Jika tidak punya akses, tampilkan error 403
        abort(403, 'Unauthorized action.');
    }
}