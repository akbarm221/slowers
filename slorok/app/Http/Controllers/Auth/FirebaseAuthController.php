<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;

class FirebaseAuthController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/service-account.json'));

        $this->auth = $factory->createAuth();
    }

    // Menampilkan halaman login
    public function showLogin()
    {
        // Jika sudah login, redirect langsung ke dashboard
        if (Session::has('firebase_user')) {
             return redirect()->route('admin.infografis.index');
        }

        return view('auth.login');
    }

    // Verifikasi token dari frontend
    public function verifyToken(Request $request)
    {
        $request->validate(['idToken' => 'required|string']);

        try {
            // Verifikasi token dari frontend
            $verifiedIdToken = $this->auth->verifyIdToken($request->idToken);

            // Ambil UID
            $uid = $verifiedIdToken->claims()->get('sub');

            // Ambil data user dari Firebase
            $firebaseUser = $this->auth->getUser($uid);

            // Simpan user ke session Laravel
            Session::put('firebase_user', [
                'uid' => $firebaseUser->uid,
                'email' => $firebaseUser->email,
                'name' => $firebaseUser->displayName ?? 'Admin',
            ]);

            return response()->json(['status' => 'success']);

        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 401);
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/login');
    }
}
