<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FirebaseAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('firebase_user')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
