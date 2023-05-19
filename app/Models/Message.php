<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function next_message()
    {
        return $this->belongsTo(Message::class, 'next_message');
    }

    public function scopeHook(Builder $query, string $hook_name)
    {
        return $query->where('hook', $hook_name);
    }

    public function scopeSortMsg(Builder $query)
    {
        return $query->orderBy('order_sending', 'ASC');
    }
}
