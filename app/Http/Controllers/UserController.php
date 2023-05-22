<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

    public function store(Request $request)
    {
        try {
            if ($request->id) {
                $user   = User::where('id', $request->id)->first();
            } else {
                $user           = new User();
                $user->password = Hash::make('12345678');
            }
            $user->sapaan       = $request->sapaan;
            $user->panggilan    = $request->panggilan;
            $user->name         = $request->name;
            $user->phone        = format_phone($request->phone);
            $user->email        = $request->email;
            $user->status       = $request->status ?? 0;
            $user->role_id      = $request->role;
            $user->provinsi     = $request->prov;
            $user->kota         = $request->kab;
            $user->kecamatan    = $request->kec;
            $user->save();
            return redirect('user')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            Log::info("message", [$th]);
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }
    }

    public function remove(Request $request)
    {
        try {
            if ($request->ajax()) {
                $user = User::where('id', $request->id)->delete();
                return redirect('user')->with('success', 'Data berhasil dihapus');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
