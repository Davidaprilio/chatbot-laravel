<?php

namespace App\Http\Controllers;

use App\Models\ActionReply;
use App\Models\FlowChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            ['id' => $request->id_flow_input],
            [
                'name' => $request->name_flow_input,
                'description' => $request->description_flow_input,
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
}