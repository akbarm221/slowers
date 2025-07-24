<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EnsureFirebaseAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ada data pengguna di sesi
        if (!Session::has('firebase_user')) {
            // Jika tidak, redirect ke halaman login
            return redirect('/login');
        }

        return $next($request);
    }
}