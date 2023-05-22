<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function flow_chat()
    {
        return $this->belongsTo(FlowChat::class);
    }
}
