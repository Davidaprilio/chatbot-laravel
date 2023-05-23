<?php

namespace App\Http\Controllers;

use App\Models\ActionReply;
use App\Models\FlowChat;
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

    public function getActionReply(Request $request)
    {
        $action_replies = ActionReply::all();
        return $action_replies->map(fn(ActionReply $action_reply) => $action_reply->edge_option);
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

    public function saveActionReply(Request $request)
    {
        if($request->type) $request->merge(['type' => 'prompt_await']);
        $act_reply = ActionReply::updateOrCreate([
            'prompt_message_id' => $request->source,
            'reply_message_id' => $request->target,
        ], $request->only([
            'prompt_message',
            'type'
        ]));
        return $act_reply->edge_option;
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

    public function updateFlowChat(FlowChat $flowChat, Request $request)
    {
        return $flowChat->update($request->only([
            'name',
            'description',
            'viewport_y',
            'viewport_x',
            'viewport_zoom',
        ]));
    }
}
