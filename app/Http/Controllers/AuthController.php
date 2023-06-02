<?php

namespace App\Http\Controllers;

use App\Models\Klinik;
use App\Models\Kontak;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function attemptLogin(Request $request)
    {
        $credentials = [
            'username'     => $request->username,
            'password'  => $request->password,
        ];
        if (auth()->attempt($credentials)) {
            $user   = User::where('username', $request->username)->first();
            Kontak::init($user->id);
            Klinik::init($user->id);
            return redirect('/dashboard');
        }
        return redirect()->back()->with('error', 'Username atau Password salah');
    }
}
