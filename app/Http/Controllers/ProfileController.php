<?php

namespace App\Http\Controllers;

use App\Models\Klinik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user   = User::with('role')->where('id', Auth::user()->id)->first();
        $klinik = Klinik::where('user_id', Auth::user()->id)->first();
        return view('user.profile', compact('user', 'klinik'));
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
        return redirect('/profile');
    }

    public function store(Request $request)
    {
        if ($request->idKlinik) {
            if ($request->logo) {
                $file = $request->file('logo');
                $filename = $request->nama . '_logoKlinik.' . $file->getClientOriginalExtension();
                $file->move(public_path('web-profile'), $filename);
                $logo   = url('web-profile/' . $filename);
            } else {
                $logo   = $request->logo_text;
            }

            $klinik             = Klinik::where('id', $request->idKlinik)->first();
            $klinik->nama       = $request->nama;
            $klinik->provinsi   = $request->provinsiKlinik;
            $klinik->kota       = $request->kotaKlinik;
            $klinik->kecamatan  = $request->kecamatanKlinik;
            $klinik->maps       = $request->maps;
            $klinik->alamat     = $request->alamat;
            $klinik->logo       = $logo;
            $klinik->save();
            return redirect('profile')->with('success', 'Data berhasil di update.');
        }else{
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
}
