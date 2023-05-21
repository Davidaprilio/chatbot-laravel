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

    public function node()
    {
        return $this->hasOne(GraphNode::class)->withDefault([
            'message_id' => $this->id,
            'position_x' => 0,
            'position_y' => 0,
            'type' => 'messageNode'
        ]);
    }

    public function getNodeOptionAttribute(): array
    {
        return [
            'id' => $this->id,
            'type' => 'messageNode',
            'selected' => false,
            'data' => [
                'label' => 'Judul Pesan',
                'message' => $this->setHidden(['created_at', 'updated_at', 'id']),
            ],
            'position' => ['x' => $this->node->position_x,'y' => $this->node->position_y],
            'positionAbsolute' => ['x' => $this->node->position_x,'y' => $this->node->position_y],
            "width" => 393,
            "height" => 127,
            "dragging" => false,
            "dragHandle" => ".custom-drag-handle",
        ];
    }
}
