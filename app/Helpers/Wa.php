<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Wa 
{
    const BASE_URL = 'http://192.168.1.120:33333/api';

    static public function send(array $data) {
        array_push($data, [
            'token' => 'dev_chat'
        ]);
        $response = Http::baseUrl(self::BASE_URL)->post('/send', $data);
        return $response->json();
    }
}
