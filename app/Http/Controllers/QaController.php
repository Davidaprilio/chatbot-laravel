<?php

namespace App\Http\Controllers;

use App\Models\QA;
use App\Models\QaDetail;
use App\Models\QaType;
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
        $qa_type = QaType::all();
        return view('qa.demo', compact('qa_type'));
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
    }

    // save Json
    public function saveJson(Request $request)
    {        
        $device_id = $request->device_id ?? 1;
        $qa = QA::where('device_id', $device_id)->first() ?? new QA();
        $qa->device_id = $device_id;        
        $qa->json = $request->json;
        $qa->save();       
        $data = json_decode($request->json);        
        // QaDetail::where('qa_id', $qa->id)->delete();        
        QaDetail::truncate();
        $level =1;
        foreach ($data as $key => $value) {
            $qad = new QaDetail();
            $qad->level = $level++;
            $qad->qa_id = $qa->id;
            $qad->text = $value->text ?? null;            
            $qad->description = $value->description ?? null;
            $children = $value->children ?? false;
            $qad->has_children = $children ? 1 : 0;            
            $qad->validasi = $value->validasi ?? null;
            $qad->type = $value->type ?? null;
            $qad->json = json_encode($value);
            $qad->key = null;
            $qad->save();            
            if ($children) { 
                $key = 1;               
                foreach ($children as $value) {
                    $this->SaveChild($qa,$value, $qad->id,$key++);                    
                }                                
            }                       
        }
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan', 'data' => $request->all()]);
    }

    protected function SaveChild($qa,$value, $parent_id = null,$key=1)
    {
        $children = $value->children ?? false;
        $qad = new QaDetail();
        $qad->qa_id = $qa->id;
        $qad->parent_id = $parent_id;
        $qad->has_children = $children ? 1 : 0;
        $qad->text = $value->text ?? null;                    
        $qad->description = $value->description ?? null;
        $qad->validasi = $value->validasi ?? null;
        $qad->type = $value->type ?? null;
        $qad->json = json_encode($value);
        $qad->key = $key;
        $qad->save();           
        if ($children) {            
            $key2 = 1;              
            foreach ($children as $value) {                  
                $this->SaveChild($qa,$value, $qad->id,$key2++);
            }            
        }        
    }    
}
