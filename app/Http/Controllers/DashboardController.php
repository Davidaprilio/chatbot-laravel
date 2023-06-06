<?php

namespace App\Http\Controllers;

use App\Models\SettingWeb;
use App\Models\User;
use App\Models\Device;
use App\Models\FlowChat;
use App\Models\Kontak;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = [
                    'total_user'        => User::count(),
                    'total_device'      => Device::with('user', 'server')->count(),
                    'total_kontak'      => Kontak::count(),
                    'total_flow'        => FlowChat::count(),
                    'customers'         => Customer::with('last_session.last_chat')->whereHas('last_session.last_chat')->get(),
                    'user'              => User::get(),
                    'flows'              => FlowChat::get(),
        ];          
        return view('layouts.dashboard', $data);
    }

    public function settingWeb(Request $request)
    {
        $web    = SettingWeb::first();
        return view('layouts.setting-web', compact('web'));
    }

    public function settingWebStore(Request $request)
    {
        $web            = SettingWeb::where('id', $request->id_web)->first();
        // dd($request->id_web);

        if ($request->web_logo) {
            $file = $request->file('web_logo');
            $filename = $web->web_title . '_cover.' . $file->getClientOriginalExtension();
            $file->move(public_path('web-profile'), $filename);
            $logo   = url('web-profile/' . $filename);
        } else {
            $logo   = $request->logo_text;
        }

        $web->web_title = $request->web_title;
        $web->web_logo  = $logo;
        $web->save();
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
