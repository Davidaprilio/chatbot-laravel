<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klinik extends Model
{
    use HasFactory;

    public static function init($id = false)
    {
        $klinik = Klinik::where('user_id', $id)->first();
        $user   = User::where('id', $id)->first();
        if (!$klinik) {
            $klink = new Klinik();
            $klink->user_id = $id;
            $klink->nama = $user->name;
            $klink->save();
        }
    }
}
