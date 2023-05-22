<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user   = User::where('id', Auth::user()->id)->first();
        return view('user.profile', compact('user'));
    }
}
