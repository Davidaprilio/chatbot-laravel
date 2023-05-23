<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $guraded = ['id'];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
