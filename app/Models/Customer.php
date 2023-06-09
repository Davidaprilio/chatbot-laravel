<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    use HasFactory;

    protected $casts = [
        'more_data' => AsArrayObject::class
    ];

    protected $fillable = [
        'more_data',
    ];

    protected $guarded = ['id'];


    public function getPhotoAttribute()
    {
        return $this->profile_photo ?? 'https://ui-avatars.com/api/?background=random&text=random&name=' . urlencode($this->name);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function chat_sessions()
    {
        return $this->hasMany(ChatSession::class);
    }

    public function last_session()
    {
        return $this->hasOne(ChatSession::class)->latest();
    }

    public function details() {
        $cusMore = CustomerDetail::user(Auth::id());
        return $this->newHasOne($cusMore->newQuery(), $this, 'customer_id', 'id');
    }

    public function scopeUser(Builder $query, int $user_id)
    {
        return $query->where('user_id', $user_id ?? auth()->id());
    }
}
