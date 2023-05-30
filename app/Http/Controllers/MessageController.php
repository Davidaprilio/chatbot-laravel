<?php

namespace App\Http\Controllers;

use App\Models\ActionReply;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $message    = Message::get();
        return view('whatsapp.message.index', compact('message'));
    }

    public function credit(Request $request)
    {
        $message        = '';
        $list_message   = Message::get();
        if ($request->id) {
            $message    = Message::where('id', $request->id)->first();
        }
        if ($request->ajax()) {
            $message    = Message::where('id', $request->id)->first();
            return $message;
        }
        return view('whatsapp.message.form', compact('message', 'list_message'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->id) {
                $message            = Message::where('id', $request->id)->first();
            } else {
                $message                = new Message();
                $message->flow_chat_id  = 1;
            }
            $message->title         = $request->title;
            $message->text          = $request->text;
            $message->type          = $request->type;
            $message->next_message  = $request->next_message;
            Log::info('success msg', [$message]);
            $message->save();
            return redirect('message')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            Log::info('error msg', [$th]);
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }
    }

    public function remove(Request $request)
    {
        if ($request->ajax()) {
            if ($request->msg == 1) {
                $message    = Message::where('id', $request->id)->delete();
                $ar             = ActionReply::where('prompt_message_id', $request->id)->orWhere('reply_message_id', $request->id)->delete();
            }
            if ($request->ar == 1) {
                $ar    = ActionReply::where('id', $request->id)->delete();
            }
        }
    }

    public function indexAR(Request $request)
    {
        $action_rep = ActionReply::get();
        return view('whatsapp.action-rep.index', compact('action_rep'));
    }

    public function creditAR(Request $request)
    {
        $action_rep     = '';
        $list_message   = Message::get();
        if ($request->id) {
            $action_rep = ActionReply::where('id', $request->id)->first();
        }
        if ($request->ajax()) {
            $message    = Message::where('id', $request->id)->first();
            return $message;
        }
        return view('whatsapp.action-rep.credit', compact('action_rep', 'list_message'));
    }

    public function storeAR(Request $request)
    {
        try {
            if ($request->id) {
                $message    = ActionReply::where('id', $request->id)->first();
            } else {
                $message    = new ActionReply();
            }
            $message->title             = $request->title;
            $message->prompt_response   = $request->prompt_response;
            $message->type              = $request->type;
            $message->save();
            return redirect('action-replies')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            Log::info('error ar', [$th]);
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }
    }

    private function inertiaRootView()
    {
        Inertia::setRootView('layouts.admin-inertia');
    }

    public function inertia_create_msg(Request $request)
    {
        $this->inertiaRootView();
        return Inertia::render('Message/CreateMessage')->withViewData([
            'title' => 'Create Message',
            'breadcrumbs' => [
                '<i class="fa fa-home"></i>' => url('dashboard'),
                'Message' => url('message.index'),
                'Create Message' => url('message.create')
            ]
        ]);
    }

    public function inertia_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'type' => 'required',
            'next_message' => 'required',
        ]);

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'data' => $request->all()
        ]);
    }
}
