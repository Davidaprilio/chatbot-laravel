<?php

namespace App\Http\Controllers;

use App\Helpers\Whatsapp;
use App\Models\Device;
use App\Models\FlowChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $user   = User::get();
        $device = Device::with('user', 'server')->where('user_id', Auth::id())->get();
        return view('whatsapp.device.device', compact('device', 'user'));
    }

    public function store(Request $request)
    {
        try {
            $device             = new Device();
            $device->token      = RandomString();
            $device->label      = $request->label;
            $device->phone      = format_phone($request->phone);
            $device->user_id    = $request->user;
            $device->server_id  = 1;
            $device->save();
            return redirect('device')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('device')->with('error', 'Gagal menyimpan data');
        }
    }

    public function remove(Request $request)
    {
        try {
            $device = Device::where('id', $request->id)->delete();
            return redirect('device')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('device')->with('error', 'Gagal menghapus data');
        }
    }

    public function detail(Request $request, $id)
    {
        $device = Device::where('id', $id)->first();
        return view('whatsapp.device.deviceiframe', compact('device', 'id'));
    }

    function Show(Request $request)
    {
        $apikey = $request->device_key;
        $method = $request->method();
        $cmd    = $request->cmd;
        $device = Device::where('device_key', $apikey)->first();

        if (!$device) {
            return response()->json([
                'message' => 'Device not found',
            ], 404);
        }

        if ($device->end_date) {
            if ($device->end_date < date('Y-m-d')) {
                // jika next_send_notif lebih kecil dari sekarang maka kirim notif
                if ($device->next_send_notif < date('Y-m-d H:i:s')) {
                    $k = Whatsapp::send([
                        'token' => '1',
                        'phone' => $device->phone,
                        'message' => 'Mohon maaf layanan anda sudah berakhir pada tanggal ' . $device->end_date . ', silahkan hubungi admin untuk memperpanjang layanan anda',
                    ]);
                    // next_send_notif jeda 6 jam
                    $device->next_send_notif = date('Y-m-d H:i:s', strtotime('+6 hours'));
                    $device->save();
                }

                return response()->json([
                    'message' => 'Device expired',

                ], 404);
            }
        }

        if ($cmd) {
            $data           = [];
            $data           = $request->all();
            $data['token']  = $device->token;
            $data['webhook']  = $device->webhook;
            return $this->excurl($device->server->host . '/api/' . $cmd, $method, $device->server->apikey, $data);
        } else {
            return $device;
        }
    }

    private function excurl($url, $method = "GET", $apikey, $data = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "apikey: " . $apikey,
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $r = [
                'status' => 'error',
                'message' => $err,
            ];
            return json_encode($r);
        } else {
            return $response;
        }
    }

    public function qrcode(Request $request, $id)
    {
        $devices = Device::where('id', $id)->first();
        if (!$devices) {
            return response()->json([
                'message' => 'Device not found',
            ], 404);
        }
        $bg_color = $request->get('bg') ? "#" . $request->get('bg') : 'transparent';
        $card_color = $request->get('card-bg') ?? 'fff';
        return view('whatsapp.device.device_show', [
            'device' => $devices,
            'bgColor' => $bg_color,
            'bgCard' => "#" . $card_color,
        ]);
    }

    public function start(Request $request, $id)
    {
        $device = Device::where('id', $id)->first();
        if (!$device) {
            return response()->json([
                'message' => 'Device not found',
            ], 404);
        }
        $result = Whatsapp::start(['token' => $device->token, "webhook" => $device->webhook]);
        try {
            if ($result->message == 'AUTHENTICATED') {
                $device->update([
                    'status'    => 'AUTHENTICATED',
                    'phone'     => $result->phone,
                    'pic'        => $result->pic ?? '',
                    'name'      => $result->name ?? 'null',
                ]);
            } else {
                $device->update([
                    'status'    => 'NOT AUTHENTICATED',
                    'phone'     => null,
                    'pic'        => null,
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $result;
    }

    public function restart(Request $request, $id)
    {
        $device = Device::where('id', $id)->first();
        if (!$device) {
            return response()->json([
                'message' => 'Device not found',
            ], 404);
        }
        $result = Whatsapp::start(['token' => $device->token]);
        return $result;
    }

    public function logout(Request $request, $id)
    {
        $device = Device::where('id', $id)->first();
        $result = Whatsapp::logout(['token' => $device->token]);
        return $result;
    }

    // test
    public function test(Request $request, $id)
    {
        $device = Device::where('id', $id)->first();
        $result = Whatsapp::send(['token' => $device->token, 'phone' => $request->phone, 'message' => 'test']);
        return $result;
    }

    // request devices by email user



    // public function gen_qr()
    // {
    //     try{
    //         $res = Whatsapp::qrcode([
    //             'token' => $devices->id,
    //         ]);

    //         // Jika Token Tidak Tersedia Start Device dulu
    //         if ($res->message === "token tidak tersedia") {
    //             Whatsapp::start([
    //                 'token' => (string)$devices->id,
    //                 'mode' => $devices->mode ?? 'md'
    //             ]);
    //             $res = Whatsapp::qrcode([
    //                 'token' => $devices->id,
    //             ]);
    //         }
    //         if ($res->message === "AUTHENTICATED") {
    //             $phones = implode([$res->data->id]);
    //             $phone  = explode(':', $phones);
    //             DB::table('devices')->where('id',$device->id)->update([
    //                 'status'    => 'AUTHENTICATED',
    //                 'phone'     => $phone[0],
    //                 'pic'		=> $res->pic ?? '',
    //                 'name'      => ($res->data->verifiedName =='' ?  $res->data->name : $res->data->verifiedName) ?? 'null',
    //             ]);
    //         } else if ($res->message === "NOT AUTHENTICATED") {
    //             $devices->update([
    //                 'status'    => 'NOT AUTHENTICATED',
    //                 'phone'     => ''
    //             ]);
    //         }
    // } catch (\Throwable $th) {
    //     return response()->json([
    //         'error'     => 'Request failed',
    //         'message'   => $th->getMessage(),
    //     ], 500);
    // }
    // return response()->json([
    //     'data' => $res,
    // ]);
    // }

    public function flows(Device $device, Request $request)
    {
        return FlowChat::with('device')->where('user_id', Auth::id())->get();
    }


    public function apply_flows(Device $device, Request $request)
    {
        $request->validate([
            'flow_chat_id' => 'required'
        ]);
        $is_overwrite = $request->overwrite ?? false;

        $flow = FlowChat::with('device')->firstWhere('id',$request->flow_chat_id);
        if ($flow === null) {
            return response()->json([
                'message' => "Flow Chat with id:{$request->flow_chat_id} not found"
            ], Response::HTTP_NOT_FOUND);
        }

        if ($flow->device !== null && $is_overwrite === false) {
            return response()->json([
                'message' => "Flow Chat with id:{$request->flow_chat_id} already used by device id:{$flow->device->id}"
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($is_overwrite) {
            $flow->device->update([
                'flow_chat_id' => null
            ]);
        }

        $device->update([
            'flow_chat_id' => $flow->id
        ]);

        return response()->json([
            'message' => "Success applying flow chat to device"
        ]);
    }

    public function drop_flow(Device $device, Request $request)
    {
        $device->update([
            'flow_chat_id' => null
        ]);

        return response()->json([
            'message' => "Success drop flow chat from device"
        ]);
    }
}
