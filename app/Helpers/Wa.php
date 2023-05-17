<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Wa 
{
    const BASE_URL = 'http://103.167.35.210:7081/api';

    static public function send(array $data) {
        return self::api()->post('/send', array_merge([
            'token' => 'dev_chat',
        ], $data))->json();
    }
    
    static private function api()
    {
        $client = Http::baseUrl(self::BASE_URL);
        $client->withHeaders([
            'Content-Type' => 'application/json',
            'apikey' => 'api-quods-2023-msd'
        ]);
        return $client;
    }
}
