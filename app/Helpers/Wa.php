<?php 

namespace App\Helpers;

use Carbon\Carbon;
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

    static public function parseMessage(string $text, array|object $data)
    {
        $now = now();

        $data = array_merge([
            '_time' => self::greetTime($now),
            '_date' => $now->isoFormat('LL'),
            '_day' => $now->dayName
        ], $data);

        foreach ($data as $key => $value) {
            $text = str_replace("[{$key}]", $value, $text);
        }
        return $text;
    }

    /**
     * @return string siang,malam,sore,pagi
     */
    static public function greetTime(Carbon $date = null)
    {
        if ($date === null) $date = Carbon::now();
        $greet = match (true) {
            $date->hour >= 18 => trans('malam'),
            $date->hour >= 15 => trans('sore'),
            $date->hour >= 10 => trans('siang'),
            $date->hour >= 4 => trans('pagi'),
            default => trans('malam'),
        };
        return $greet;
    }
}
