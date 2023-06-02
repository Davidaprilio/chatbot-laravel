<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $kontak   = Kontak::get();
        return view('whatsapp.kontak.index', compact('kontak'));
    }

    public function credit(Request $request)
    {
        $kontak     = '';
        $title      = 'Tambah Kontak';
        $kategori = Kontak::groupBy('kategori')->select('kategori')->get();
        if ($request->id) {
            $kontak   = Kontak::where('id', $request->id)->first();
            $title    = 'Edit Kontak';
        }
        return view('whatsapp.kontak.credit', compact('kontak', 'title', 'kategori'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->id) {
                $kontak   = Kontak::where('id', $request->id)->first();
            } else {
                $kontak             = new Kontak();
                $kontak->user_id    = Auth::id();
            }
            $kontak->sapaan         = $request->sapaan;
            $kontak->panggilan      = $request->panggilan;
            $kontak->nama           = $request->nama;
            $kontak->tanggal_lahir  = $request->tanggal_lahir;
            $kontak->email          = $request->email;
            $kontak->phone          = format_phone($request->phone);
            $kontak->kategori       = $request->kategori;
            $kontak->agama          = $request->agama;
            $kontak->jenis_kelamin  = $request->jenis_kelamin;
            $kontak->provinsi       = $request->provinsi;
            $kontak->kota           = $request->kota;
            $kontak->kecamatan      = $request->kecamatan;
            $kontak->alamat         = $request->alamat;
            $kontak->save();
            return redirect('kontak')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            Log::info('error kontak', [$th]);
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }
    }

    public function remove(Request $request)
    {
        try {
            $device = Kontak::where('id', $request->id)->delete();
            return redirect('kontak')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('kontak')->with('error', 'Gagal menghapus data');
        }
    }
}
