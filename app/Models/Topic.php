<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function chat_session()
    {
        return $this->belongsTo(ChatSession::class);
    }
    
    public function kategori()
    {
        return $this->morphToMany(Kategori::class, 'categorizable', 'kategori_pivot');
    }
}
