<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        return view('chat-log', [
            'customers' => Customer::with('last_session.last_chat')->whereHas('last_session.last_chat')->get()
        ]);
    }

    public function view_chat(Request $request)
    {
        $cust = Customer::find($request->customer);
        return view('components.chat.view-chat', [
            'customer' => $cust,
            'sessions' => $cust->chat_sessions()->with(['chats.reference_message', 'topic', 'device'])->get()
        ]);
    }
}
