<?php

namespace App\Http\Controllers;

use App\Models\ActionReply;
use App\Models\FlowChat;
use App\Models\GraphNode;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GraphController extends Controller
{
    public function index(FlowChat $flowChat, Request $request)
    {
        $messages = $flowChat->messages();
        if ($request->nodesID) {
            $messages->whereIn('id', $request->nodesID);
        }
        return $messages->get()->map(fn(Message $message) => $message->node_option);
    }

    public function getActionReply(Request $request)
    {
        $action_replies = ActionReply::all();
        return $action_replies->map(fn(ActionReply $action_reply) => $action_reply->edge_option);
    }

    public function saveMessage(FlowChat $flowChat, Request $request)
    {    
        if ($request->text === null) {
            $request->merge(['text' => '']);
        }
        $msg = Message::updateOrCreate([
            'id' => $request->id,
            'flow_chat_id' => $flowChat->id,
        ], $request->only([
            'text',
            'title',
            'type',
            'hook',
            'event_value',
            'trigger_event',
            'order_sending',
        ]));
        $msg->refresh();
        $node_option = $msg->node_option;
        $node_option['selected'] = true;
        $node_option['data']['message'] = $msg;
        return $node_option;
    }

    public function saveActionReply(Request $request)
    {
        $explode_res_text = explode(',', $request->prompt_response);
        if (count($explode_res_text) === 1) {
            $res_text = $explode_res_text[0];
        } else {
            $res_text = json_encode($explode_res_text);
        }

        // sourceHandle: action_reply|next_msg
        if ($request->sourceHandle === 'action_reply') {
            if($request->type) $request->merge(['type' => 'prompt_await']);
            $act_reply = ActionReply::updateOrCreate([
                'prompt_message_id' => $request->source,
                'reply_message_id' => $request->target,
            ], array_merge($request->only([
                'prompt_message',
                'type'
            ]), [
                'prompt_response' => $res_text
            ]));
            return $act_reply->edge_option;
        } elseif ($request->sourceHandle === 'next_msg') {
            $msg = Message::find($request->source);
            if ($msg === null) return response()->json([
                'message' => 'Source message not found',
                'query' => $request->all(),
            ], Response::HTTP_BAD_REQUEST);

            $msg->next_message = $request->target;
            $msg->save();

            return $msg->edge_option;
        }

        return response()->json([
            'message' => 'Source handle not found',
            'query' => $request->all(),
        ], Response::HTTP_BAD_REQUEST);
    }

    public function deleteActionReply(FlowChat $flowChat, Request $request)
    {
        $edges = collect($request->edges)->filter(fn($edge) => $edge['type'] === 'remove')->map(function($edge) {
            $tokenize = explode('-', $edge['id']);
            return [
                'id' => $tokenize[1],
                'type' => "{$tokenize[2]}-{$tokenize[3]}"
            ];
        })->groupBy('type');

        $deleted_nxt_msg = 0;
        $deleted_act_rly = 0;

        if (isset($edges['next-msg'])) {
            $messages_id_have_next_msg = $edges['next-msg']->pluck('id');
            $deleted_nxt_msg = Message::whereIn('id', $messages_id_have_next_msg)->update(['next_message' => null]);
        }

        if (isset($edges['action-reply'])) {
            $action_replies_id = $edges['action-reply']->pluck('id');
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
    
            $deleted_act_rly = ActionReply::whereIn('id', $action_replies_id)->delete();
        }
      
        return [
            'deleted' => $deleted_nxt_msg + $deleted_act_rly,
            'deleted_action_reply' => $deleted_act_rly,
            'deleted_next_message' => $deleted_nxt_msg,
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
