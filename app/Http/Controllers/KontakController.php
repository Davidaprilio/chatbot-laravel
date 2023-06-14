<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerDetail;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Yajra\DataTables\Facades\DataTables;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $is_initialized = CustomerDetail::is_initiated(Auth::id());
        if($request->ajax()) {
            if($is_initialized) {
                $customers = Customer::with('details')->user(Auth::id());                
            } else {
                $customers = Customer::user(Auth::id());
            }
            $dt = DataTables::eloquent($customers);
            
            $dt->editColumn('created_at', fn ($customer) => $customer->created_at->format('d-m-Y H:i:s'));
            $dt->editColumn('updated_at', fn ($customer) => $customer->updated_at->format('d-m-Y H:i:s'));

            return $dt->addColumn('_action', fn ($customer) => view('whatsapp.kontak.table-action', compact('customer')))
                ->make(true);
        }

        $column_names = $this->get_column_names();
        $column_names = array_combine($column_names, $column_names);
        foreach ($column_names as $k => $v) $column_names[$k] = str()->headline($v);
        if($is_initialized) {
            foreach (CustomerDetail::user(Auth::id())->getColumn() as $col) $column_names["details.{$col}"] = str()->headline($col);
        }
        return view('whatsapp.kontak.index', compact('column_names'));
    }

    public function credit(Request $request)
    {
        $kontak     = '';
        $title      = 'Tambah Kontak';
        $kategori = Customer::groupBy('kategori')->select('kategori')->get();
        if ($request->id) {
            $kontak   = Customer::where('id', $request->id)->first();
            $title    = 'Edit Kontak';
        }
        return view('whatsapp.kontak.credit', compact('kontak', 'title', 'kategori'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->id) {
                $kontak   = Customer::where('id', $request->id)->first();
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
            $device = Customer::where('id', $request->id)->delete();
            return redirect('kontak')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('kontak')->with('error', 'Gagal menghapus data');
        }
    }
    
    private function get_column_names()
    {
        $column_from_table = DB::getSchemaBuilder()->getColumnListing('customers');
        return array_filter($column_from_table, fn ($column) => array_search($column, explode(',', "user_id,more_data")) === false);
    }

    public function export(Request $request)
    {
        $columns = explode(',', $request->columns);
        $available_columns = array_intersect($columns, $this->get_column_names());

        $is_with_iteration = $request->has('iteration');
        $seletor = $request->has('alias') ? array_map(fn ($column) => $column . " as " .str()->headline($column), $available_columns) : $available_columns;
        $customers = Customer::select($seletor)->where('user_id', Auth::id())->get();

        return FastExcel::data($customers)->download('kontak.xlsx');
    }
}
