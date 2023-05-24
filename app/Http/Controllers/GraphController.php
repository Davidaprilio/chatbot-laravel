<?php

namespace App\Http\Controllers;

use App\Models\ActionReply;
use App\Models\FlowChat;
use App\Models\GraphNode;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function deleteActionReply(FlowChat $flowChat, Request $request)
    {
        $action_replies_id = collect($request->edges)->pluck('id');
        $action_replies = ActionReply::with(['replyMessage', 'promptMessage'])->whereIn('id', $action_replies_id)->get();

        // verify if all action replies are in the same flow chat
        $verified = $action_replies->every(function (ActionReply $action_reply) use ($flowChat) {
            return (
                $action_reply->replyMessage->flow_chat_id === $flowChat->id &&
                $action_reply->promptMessage->flow_chat_id === $flowChat->id
            );
        });

        if (!$verified) {
            Log::error('Action replies are not in the same flow chat', $action_replies->toArray());
            throw new \Exception('Action replies are not in the same flow chat');
        }

        $deleted = ActionReply::whereIn('id', $action_replies_id)->delete();
      
        return [
            'deleted' => $deleted,
            'flowChat' => $flowChat
        ];
    }

    public function deleteMessage(FlowChat $flowChat, Request $request)
    {
        $forced = $request->forced ?? false; 
        $messages_id = collect($request->nodes)->pluck('id');
        $messages = Message::whereIn('id', $messages_id)->get();

        // verify if all messages are in the same flow chat
        $verified = $messages->every(fn (Message $message) => $message->flow_chat_id === $flowChat->id);

        if (!$verified) {
            Log::error('Messages are not in the same flow chat', $messages->toArray());
            throw new \Exception('Messages are not in the same flow chat');
        }

        if ($forced) {
            // remove nested action replies and set null next message

        }

        try {
            $deleted = Message::whereIn('id', $messages_id)->delete();
        } catch (\Throwable $th) {
            // if erroro reason is foreign key constraint
            if ($th->getCode() === '23000' && $forced === false) {
                return response()->json([
                    'message' => 'this message is in used/connected with action reply or next message, check your flow chat again',
                ], 400);
            }
            throw $th;
        }

        return [
            'deleted' => $deleted,
            'flowChat' => $flowChat
        ];
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
