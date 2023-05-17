<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionReply extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function replyMessage()
    {
        return $this->belongsTo(Message::class, 'reply_message_id');
    }
}
