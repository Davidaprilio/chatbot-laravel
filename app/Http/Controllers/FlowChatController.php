<?php

namespace App\Http\Controllers;

use App\Models\ActionReply;
use App\Models\FlowChat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class FlowChatController extends Controller
{
    public function index(Request $request)
    {
        $flowchats = FlowChat::get();

        return view('flowchat.index', [
            'flows' => $flowchats, 
        ]);
    }

    public function show(FlowChat $flowChat, Request $request)
    {
        if ($request->ajax()) return $flowChat;
    }

    public function save(Request $request)
    {
        $flowChat = FlowChat::updateOrCreate(
            [
                'id' => $request->id_flow_input,
                'user_id' => Auth::user()->id
            ],
            [
                'name' => $request->name_flow_input,
                'description' => $request->desc_flow_input,
            ]
        );

        return redirect()->back()->with('success', 'FlowChat saved successfully!');
    }

    public function delete(FlowChat $flowChat, Request $request)
    {
        $id_messages = $flowChat->messages()->pluck('id');

        DB::beginTransaction();

        try {
            ActionReply::whereIn('prompt_message_id', $id_messages)
                ->orWhereIn('reply_message_id', $id_messages)->delete();
    
            $flowChat->messages()->update([
                'next_message' => null,
            ]);
            $flowChat->messages()->delete();
            $flowChat->delete();
            
            DB::commit(); // OK all good
        } catch (\Throwable $th) {
            DB::rollback(); // something went wrong
            Log::error($th->getMessage(), $th->getTrace());
            return redirect()->back()->with('error', 'FlowChat failed to delete!');
        }

        return redirect()->back()->with('success', 'FlowChat deleted successfully!');
    }

    public function graph_view(FlowChat $flowChat, Request $request)
    {
        $messages = Message::with('node')->where('flow_chat_id', $flowChat->id)->get();
        $nodes = $messages->map(fn(Message $message) => $message->node_option);

        $id_messages = $messages->pluck('id');
        $action_replies = ActionReply::whereIn('prompt_message_id', $id_messages)->orWhereIn('reply_message_id', $id_messages)->get();
        $edges_action_reply = $action_replies->map(fn(ActionReply $action_reply) => $action_reply->edge_option);
        // $edges = $action_replies->map(fn(ActionReply $action_reply) => $action_reply->edge_option);

        $next_messages = $flowChat->messages()->where('next_message', '!=', null)->get();
        $edges_next_message = $next_messages->map(fn(Message $message) => $message->edge_option);

        // merge edges_action_reply and edges_next_message Collection
        $edges = array_merge(
            $edges_action_reply->toArray(), 
            $edges_next_message->toArray()
        );

        $data = [
            'flowChat' => $flowChat,
            'nodes' => $nodes,
            'edges' => $edges,
        ];

        return Inertia::render('GraphMessage', $data);
    }
}
