<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customer   = Customer::get();
        return view('customer.index', compact('customer'));
    }

    public function credit(Request $request)
    {
        $customer   = '';
        if ($request->id) {
            $customer   = Customer::where('id', $request->id)->first();
        }
        return view('customer.credit', compact('customer'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->id) {
                $customer   = Customer::where('id', $request->id)->first();
            } else {
                $customer   = new Customer();
            }
            $customer->name             = $request->name;
            $customer->phone            = $request->phone;
            $customer->usia             = $request->usia;
            $customer->jenis_kelamin    = $request->jenis_kelamin;
            $customer->golongan_darah   = $request->golongan_darah;
            $customer->alamat           = $request->alamat;
            $customer->save();
            return redirect('customer')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            Log::info('error customer', [$th]);
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }
    }

    public function remove(Request $request)
    {
        try {
            $device = Customer::where('id', $request->id)->delete();
            return redirect('customer')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('customer')->with('error', 'Gagal menghapus data');
        }
    }
}
