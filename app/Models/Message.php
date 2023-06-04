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
        return $this->belongsTo(Message::class, 'next_message')->withDefault([
            'id' => 0,
            'text' => 'End of the line',
        ]);
    }

    public function replies()
    {
        return $this->hasMany(ActionReply::class, 'prompt_message_id');
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

    // representation of the node
    public function getNodeOptionAttribute(): array
    {
        return [
            'id' => (string) $this->id,
            'type' => 'messageNode',
            'selected' => false,
            'data' => [
                'label' => 'Judul Pesan',
                'message' => $this->setHidden(['created_at', 'updated_at', 'id']),
            ],
            'position' => ['x' => $this->node->position_x, 'y' => $this->node->position_y],
            'positionAbsolute' => ['x' => $this->node->position_x, 'y' => $this->node->position_y],
            "width" => 393,
            "height" => 327,
            "dragging" => false,
            "dragHandle" => ".custom-drag-handle",
        ];
    }

    // representation of the edge (next_message)
    public function getEdgeOptionAttribute(): array
    {
        return [
            'id' => "edge-{$this->id}-next-msg",
            'source' => (string) $this->id,
            'target' => (string) $this->next_message,
            'label' => 'Next Message To',
            'type' => 'nextmsgEdge',
            'sourceHandle' => 'next_msg', // value from Node Handle id on jsx
            'data' => $this->setHidden([
                'id',
                'created_at',
                'updated_at',
            ])->toArray(),
            'markerEnd' => [
                'type' => 'arrowclosed', 
                'color' => '#b1b1b7' ,
                'width' => 20,
                'height' => 20,
                'strokeWidth' => 1
            ],
            'style' => [
                'strokeWidth' => 2,
            ],
        ];
    }
}
