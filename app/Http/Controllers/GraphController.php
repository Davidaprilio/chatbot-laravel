<?php

namespace App\Http\Controllers;

use App\Models\GraphNode;
use App\Models\Message;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::with('node')->get();
        return $messages->map(fn(Message $message) => $message->node_option);
    }

    public function saveMessage(Request $request)
    {
        if ($request->text === null) {
            $request->merge(['text' => '']);
        }
        $msg = Message::updateOrCreate([
            'id' => $request->id
        ], $request->only([
            'text',
            'title',
            'type',
            'hook',
            'event_value',
            'trigger_event',
            'order_sending',
        ]));
        $node_option = $msg->node_option;
        $node_option['selected'] = true;
        return $node_option;
    }

    public function nodeMessageStore(Request $request)
    {
        return GraphNode::updateOrCreate([
            'message_id' => $request->message_id
        ], [
            'position_x' => $request->position_x,
            'position_y' => $request->position_y,
            'type' => 'messageNode'
        ]);
    }
}
