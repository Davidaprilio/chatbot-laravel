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

    public function promptMessage()
    {
        return $this->belongsTo(Message::class, 'prompt_message_id');
    }

    public function getEdgeOptionAttribute($key)
    {
        return [
            "id" => (string) $this->id,
            "source" => (string) $this->prompt_message_id,
            "target" => (string) $this->reply_message_id,
            "label" => $this->title,
            // "type" => '' 
        ];
    }
}
