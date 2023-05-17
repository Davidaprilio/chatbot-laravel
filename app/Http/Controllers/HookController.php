<?php

namespace App\Http\Controllers;

use App\Helpers\Wa;
use App\Models\ChatSession;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HookController extends Controller
{
    protected $Log;

    public function __construct()
    {
        $this->Log = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/hook.log'),
        ]);
    }

    public function callback(Request $request)
    {
        $this->Log->info('Hook Recived', $request->all());

        $_cust = $this->getCustomer($request->phone, $request->name);
        
        $this->Log->info('Customer', $_cust);

        $session = ChatSession::firstOrCreate([
            'customer_id' => $_cust['customer']->id,
            'ended_at' => null,
        ]);

        $session->chat()->create([
            'message_id' => $request->id,
            'from_me' => $request->fromMe,
            'text' => $request->message,
            'timestamp' => $request->timestamp,
        ]);


        // create response message kirim menu
        
        $res = Wa::send([
            'phone' => $request->phone,
            'message' => 'Halo, terimakasih telah menghubungi kami. Silahkan pilih menu dibawah ini',
        ]);


        $this->Log->info('Session', [$session]);

        return response()->json([
            'success' => true,
        ]);
    }

    protected function getHookMessageType(Customer $customer)
    {
        
        
    }


    /**
     * @return array<bool,Customer>
     */
    protected function getCustomer(string $phone, string $pushname)
    {
        $Customer = Customer::firstOrCreate([
            'phone' => $phone,
        ], [
            'pushname' => $pushname,
        ]);
        
        if ($Customer->pushname != $pushname) {
            $Customer->pushname = $pushname;
            $Customer->save();
        }

        return [
            'is_new' => $Customer->created_at->isToday(),
            'customer' => $Customer
        ];
    }

    public function test(Request $request)
    {
        // {"status":true,"type":"conversation","server_phone":"628884966841","id":"338C2354498664AFDC1AE834E99BC693","fromMe":false,"phone":"6285231028718","name":"</David>","message":"Hui","profilePic":null,"timestamp":1684302833,"selectedButtonId":null,"selectedDisplayText":null,"selectedRowId":null,"selectedTitle":null,"token":"dev_chat","payload":{"key":{"remoteJid":"6285231028718@s.whatsapp.net","fromMe":false,"id":"338C2354498664AFDC1AE834E99BC693"},"messageTimestamp":1684302833,"pushName":"</David>","broadcast":false,"message":{"conversation":"Hui","messageContextInfo":{"deviceListMetadata":{"senderKeyHash":"yIu1uKQE1CtJQg==","senderTimestamp":"1684240111","recipientKeyHash":"F3AZNFQNM/0xHw==","recipientTimestamp":"1684301832"},"deviceListMetadataVersion":2}}}} 

        // send to webhook
        $response = Http::post('http://192.168.1.120:8000/api/hook/whatsapp', [
            'status' => true,
            'type' => 'conversation',
            'server_phone' => '628884966841',
            'id' => '338C2354498664AFDC1AE834E99BC693',
            'fromMe' => false,
            'phone' => '6285231028718',
            'name' => '</David>',
            'message' => 'Hui',
            'profilePic' => null,
            'timestamp' => 1684302833,
            'selectedButtonId' => null,
            'selectedDisplayText' => null,
            'selectedRowId' => null,
            'selectedTitle' => null,
            'token' => 'dev_chat',
            'payload' => [
                'key' => [
                    'remoteJid' => '6285231028718@s.whatsapp.net',
                    'fromMe' => false,
                    'id' => '338C2354498664AFDC1AE834E99BC693'
                ],
                'messageTimestamp' => 1684302833,
                'pushName' => '</David>',
                'broadcast' => false,
                "message" => [
                    "conversation" => "Halo pak",
                    "messageContextInfo" => [
                        "deviceListMetadata" => [
                            "senderKeyHash" => "yIu1uKQE1CtJQg==",
                            "senderTimestamp" => "1684240111",
                            "recipientKeyHash" => "F3AZNFQNM/0xHw==",
                            "recipientTimestamp" => "1684301832"
                        ],
                        "deviceListMetadataVersion" => 2
                    ]
                ]
            ]

        ]);

        return $response->json();
    }
}
