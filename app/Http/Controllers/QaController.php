<?php

namespace App\Http\Controllers;

use App\Models\QA;
use Illuminate\Http\Request;

class QaController extends Controller
{
    public function index(Request $request)
    {
        return view('qa.index');
    }    
    // demo

    public function demo(Request $request)
    {
        return view('qa.demo');
    }

    // save Json
    public function saveJson(Request $request)
    {        
        $device_id = $request->device_id ?? 1;
        $qa = QA::where('device_id', $device_id)->first() ?? new QA();
        $qa->device_id = $device_id;        
        $qa->json = $request->json;
        $qa->save();
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan', 'data' => $request->all()]);
    }
    // ajax-load-qa
    public function ajaxLoadQA(Request $request)
    {
        $device_id = $request->device_id ?? 1;
        $qa = QA::where('device_id', $device_id)->first();
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan', 'data' => $qa->json ?? null]);
    }


    public function new()
    {
        # code...
        return view('qa2.index');
    }

    public function lihat()
    {
        # code...
        return view('qa2.lihat');
    }}
