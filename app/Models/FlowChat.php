<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowChat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function device()
    {
        return $this->hasOne(Device::class);
    }

    public function scopeOwnUser(Builder $query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
