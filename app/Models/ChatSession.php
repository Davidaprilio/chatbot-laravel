<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function chat()
    {
        return $this->hasMany(Chat::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
