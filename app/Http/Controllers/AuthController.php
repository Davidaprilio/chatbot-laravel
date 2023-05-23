<?php

namespace App\Http\Controllers;

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
            return redirect('/dashboard');
        }
        return redirect()->back()->with('error', 'Username atau Password salah');
    }
}
