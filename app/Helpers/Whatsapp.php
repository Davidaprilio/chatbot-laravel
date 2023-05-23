<?php

namespace App\Helpers;

use App\Models\Device;

class Whatsapp
{
  public static function start($data)
  {
    return self::curl("api/start", $data);
  }

  public static function qrcode($data)
  {
    return self::curl("api/qrcode", $data, "GET");
  }

  public static function send($data)
  {
    return self::curl("api/send", $data);
  }

  public static function queue($data)
  {
    return self::curl("api/antrian", $data);
  }

  public static function cek_antrian($data)
  {
    return self::curl("api/cek-antrian", $data);
  }

  public static function delete($data)
  {
    return self::curl("api/delete-antrian", $data);
  }

  public static function logout($data)
  {
    return self::curl("api/logout", $data, "POST");
  }

  public static function close($data)
  {
    return self::curl("api/close", $data, "POST");
  }

  public static function cpu()
  {
    $device = Device::first();
    return self::curl("cpu", ['token' => $device->token], "GET");
  }

  public static function list()
  {
    $device = Device::first();
    return self::curl("api/devices", ['token' => $device->token], "GET");
  }

  public static function listgroup($data)
  {
    return self::curl("api/group-list-with-contact", $data);
  }

  public static function servers()
  {
    $device = Device::first();
    return self::curl("api/servers", ['token' => $device->token], "GET");
  }

  public static function restart($data)
  {

    return self::curl("api/restart", $data, "POST");
  }

  private  static function curl($url, $data, $method = "POST")
  {
    // return $data;
    $device_id  = $data['token'] ?? $data['id'] ?? null;
    $device     = Device::with('server')->where('id', $device_id)->orWhere('token', $device_id)->first();
    if ($device) {
      $url = $device->server->host."/". $url;
      $curl = curl_init();
      curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
          "Content-Type: application/json",
          "apikey: " . $device->server->apikey

        ],
      ]);
      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        return (object) [
          'status' => false,
          'message' => "Server offline",
          "error" => $err,
          'data' => $data
        ];
      } else {
        if (gettype($response) == "string") {
          $response = json_decode($response);
        }
        return $response;
      }
    } else {
      return (object) [
        'status' => false,
        'message' => "Device not found",
        'data' => $data
      ];
    }
  }
}
