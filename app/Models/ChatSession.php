<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function last_chat()
    {
        return $this->hasOne(Chat::class)->latest();
    }

    public function topic()
    {
        return $this->hasOne(Topic::class);
    }
}
