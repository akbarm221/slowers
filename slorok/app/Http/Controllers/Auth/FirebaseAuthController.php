<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// Langsung panggil class Factory
use Kreait\Firebase\Factory;

class FirebaseAuthController extends Controller
{
    protected $auth;

    public function __construct()
    {
        // Membuat objek Firebase secara manual dari awal.
        // Ini adalah cara paling aman untuk menghindari konflik.
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/service-account.json'));

        // Menyimpan objek Auth ke properti untuk digunakan nanti.
        $this->auth = $factory->createAuth();
    }

    // Fungsi untuk menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Fungsi untuk memverifikasi token dari JavaScript
    public function verifyToken(Request $request)
    {
        $request->validate(['idToken' => 'required|string']);

        try {
            // Memanggil METHOD verifyIdToken() pada objek $this->auth
            $verifiedIdToken = $this->auth->verifyIdToken($request->idToken);
            $uid = $verifiedIdToken->claims()->get('sub');
            $firebaseUser = $this->auth->getUser($uid);

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

    // Fungsi untuk logout
    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/login');
    }
}