<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user   = User::get();
        return view('user.index', compact('user'));
    }

    public function credit(Request $request)
    {
        $user = '';
        $title  = 'Tambah User';
        if ($request->id) {
            $user   = User::where('id', $request->id)->first();
            $title  = 'Edit User';
        }

        return view('user.credit', compact('user', 'title'));
    }
}
