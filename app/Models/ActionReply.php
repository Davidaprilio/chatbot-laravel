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
        $resText = json_decode($this->prompt_response);
        if (!is_array($resText)) {
            $resText = [$this->prompt_response];
        }
        return [
            "id" => "edge-{$this->id}-action-reply",
            "source" => (string) $this->prompt_message_id,
            "target" => (string) $this->reply_message_id,
            "label" => $this->title,
            'sourceHandle' => 'action_reply', // value from Node Handle id on jsx
            "data" => array_merge($this->setHidden([
                'created_at',
                'updated_at',
            ])->toArray(), [
                'textReplies' => $resText,
            ]),
            "type" => 'buttonEdge',
        ];
    }

    public function getResponseTextAsStringAttribute($key)
    {
        $res_text = json_decode($this->prompt_response);
        if (is_array($res_text)) {
            $res_text = implode(',', $res_text);
        } else {
            $res_text = $this->prompt_response;
        }

        return $res_text;
    }
}
