<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerDetail;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        $is_initialized = CustomerDetail::is_initiated(Auth::id());
        
        $is_with_iteration = $request->has('iteration');
        $selector = $request->has('alias') ? array_map(fn ($column) => $column . " as " .str()->headline($column), $available_columns) : $available_columns;
        
        $selector_detail = [];
        if($is_initialized) {
            $columns_detail = CustomerDetail::user(Auth::id())->getColumn();
            
            $columns_detail = array_intersect(array_map(fn ($column) => "details.{$column}", $columns_detail), $columns);
            $columns_detail = array_map(fn ($column) => str_replace('details.', '', $column), $columns_detail);

            foreach ($columns_detail as $col) $selector_detail[] = $request->has('alias') ? $col . " as " . str()->headline($col) : $col;
        }
        // dd($selector);
        
        if($is_initialized) {
            $customers = Customer::with([
                'details' => fn ($query) => $query->select(array_merge(['customer_id', 'id'], $selector_detail))
            ])->select(
                array_merge(['id'], $selector)
            )->user(Auth::id());
        } else {
            $customers = Customer::select($selector)->user(Auth::id());
        }
        $customers = $customers->get()->toArray();
        foreach ($customers as $i => $customer) {
            // remove unnecessary data
            if (isset($customer['id']) && isset($customer['Id'])) {
                unset($customer['id']);
            }
            
            if ($is_initialized) {
                unset($customer['details']['customer_id']);
                unset($customer['details']['id']);
                foreach ($customer['details'] as $key => $value) {
                    $customer[$key] = $value;
                }
                unset($customer['details']);
            }

            $customers[$i] = $customer;
        }

        return FastExcel::data($customers)->download('kontak.xlsx');
    }

    public function custom_column()
    {
        $column_names = CustomerDetail::user(Auth::id())->getColumn();

        // get column total data in each column with Count in select
        $selector = array_map(fn ($column) => DB::raw("COUNT(`{$column}`) as `{$column}`"), $column_names);
        $columns = CustomerDetail::user(Auth::id())->select($selector)->first()->toArray();
        // dd($columns ?? null);
        return view('whatsapp.kontak.custom-column', [
            'columns' => $columns
        ]);
    }

    public function custom_column_post(Request $request)
    {
        $old_column_name = Str::snake($request->column_name);
        $new_column_name = Str::snake($request->new_column);

        $columns = CustomerDetail::user(Auth::id())->getColumn();
        if ($old_column_name) {
            if(!in_array($old_column_name, $columns)) return redirect()->back()->with('error', 'Kolom tidak ditemukan');
            
            CustomerDetail::user(Auth::id())->renameColumn($old_column_name, $new_column_name);
            return redirect()->back()->with('success', 'Nama kolom berhasil diubah');
        } else {
            if(in_array($new_column_name, $columns)) return redirect()->back()->with('error', 'Kolom sudah ada');

            CustomerDetail::user(Auth::id())->addColumn([$new_column_name]);
            return redirect()->back()->with('success', 'Kolom berhasil ditambahkan');
        }
    }

    public function custom_column_delete(Request $request)
    {
        $column = $request->column_name;
        $columns = CustomerDetail::user(Auth::id())->getColumn();
        if(!in_array($column, $columns)) return redirect()->back()->with('error', 'Kolom tidak ditemukan');

        // delete column
        CustomerDetail::user(Auth::id())->removeColumn([$column]);

        return redirect()->back()->with('success', 'Kolom berhasil dihapus');
    }
}
