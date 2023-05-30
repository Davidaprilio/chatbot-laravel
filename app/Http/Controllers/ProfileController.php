<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user   = User::with('role')->where('id', Auth::user()->id)->first();
        return view('user.profile', compact('user'));
    }

    public function save_profile(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        if ($request->cover == 'cover') {
            $file = $request->file('image');
            $filename = $user->email . '_cover.' . $file->getClientOriginalExtension();
            $file->move(public_path('img-profile'), $filename);
            $data['image'] = $filename;
            $field = 'cover_photo';
        } else {
            $file = $request->file('image');
            $filename = $user->email . '_profile.' . $file->getClientOriginalExtension();
            $file->move(public_path('img-profile'), $filename);
            $data['image'] = $filename;
            $field = 'photo';
        }
        User::where('id', Auth::id())->update([
            $field => $filename
        ]);
        // return 'ok';
        return redirect('/profile');
    }

    public function store(Request $request)
    {
        $data            = $request->data;
        $user            = User::where('id', $data['id'])->first();
        $user->sapaan    = $data['sapaan'];
        $user->panggilan = $data['panggilan'];
        $user->name      = $data['name'];
        $user->email     = $data['email'];
        $user->phone     = format_phone($data['phone']);
        $user->provinsi  = $data['provinsi'];
        $user->kota      = $data['kota'];
        $user->kecamatan = $data['kecamatan'];
        $user->save();

        return 'Data berhasil disimpan.';
    }
}
