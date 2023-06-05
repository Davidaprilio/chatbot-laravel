<?php

namespace App\Http\Controllers;

use App\Models\ActionReply;
use App\Models\FlowChat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index(Request $request, FlowChat $flow)
    {
        $message    = Message::where('flow_chat_id', $flow->id)->get();
        return view('whatsapp.message.index', compact('message', 'flow'));
    }

    public function credit(Request $request, FlowChat $flow)
    {
        $list_message   = $flow->messages()->get();
        if ($request->ajax()) {
            return $list_message;
        }
        $message        = null;
        $button         = null;
        // jika request id ada == edit
        if ($request->id) {
            $message    = $flow->messages()->where('id', $request->id)->first();
            $button     = $message->replies()->orderBy('id')->get();
        }
        return view('whatsapp.message.form', compact('message', 'list_message', 'flow', 'button'));
    }

    public function store(Request $request, FlowChat $flow)
    {
        $replies = [
            'old' => [],
            'new' => []
        ];

        if ($request->type == 'prompt') {
            if (!is_array($request->action)) {
                return redirect()->back()->with('error', 'Pesan dengan type Pertanyaan harus memiliki jawaban');
            }

            foreach ($request->action as $index => $action) {
                $merge = [
                    'action_id' => $action,
                    'response_text' => $request->button[$index],
                    'reply_id' => $request->respon[$index],
                ];
                if ($action === "null") {
                    $replies['new'][] = $merge;
                } else {
                    $replies['old'][] = $merge;
                }
            }
            // data replies OK - sudah benar
        }

        $message = $flow->messages()->firstWhere('id', $request->id);

        DB::beginTransaction();

        try {
            if ($message === null) {
                $message = new Message();
                $message->flow_chat_id  = $flow->id;
                // $message->type_button   = $request->type_button;
                // $message->buttons       = json_encode($list_button);
            }
            $message->title         = $request->title;
            $message->text          = $request->text;
            $message->type          = $request->type;
            $message->hook          = $request->hook;
            $message->next_message  = $request->next_msg ?? null;
            if ($request->enableCondition) {
                $message->condition = $request->format_condition ?? null;
                $message->condition_type = $request->type_condition ?? null;
                $message->condition_value = $request->condition_value ?? null;
            } else {
                $message->condition = null;
            }
            if ($request->enableEventTrigger) {
                $message->event_value = $request->event_value;
                $message->trigger_event = $request->type_trigger_event;
            } else {
                $message->event_value = null;
                $message->trigger_event = null;
            }
            $message->save();

            $message->refresh();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::error($th->getMessage(), $th->getTrace());
            return redirect('message/' . $flow->id)->with('error', 'Masalah saat menyimpan pesan');
        }

        try {
            if ($message->type === 'chat' && $message->replies->count()) {
                $message->replies()->delete(); //  jika type promp sudah pasti aman gak ke delete
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::error($th->getMessage(), $th->getTrace());
            return redirect('message/' . $flow->id)->with('error', 'Masalah saat menghapus response pesan');
        }

        try {
            // update replies
            foreach ($replies['old'] as $action) {
                $response_text = explode(',', $action['response_text']);
                ActionReply::where('id', $action['action_id'])->update([
                    'prompt_response' => count($response_text) == 1 ? $response_text[0] : json_encode($response_text),
                    'reply_message_id' => $action['reply_id']
                ]);
            }
            // create new replies
            foreach ($replies['new'] as $action) {
                $response_text = explode(',', $action['response_text']);
                ActionReply::create([
                    'prompt_response' => count($response_text) == 1 ? $response_text[0] : json_encode($response_text),
                    'prompt_message_id' => $message->id,
                    'reply_message_id' => $action['reply_id'],
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            Log::error($th->getMessage(), $th->getTrace());
            return redirect('message/' . $flow->id)->with('error', 'Masalah saat menyimpan response pesan');
        }

        DB::commit();

        if ($request->saveAndBack) {
            $resSuccess = redirect('message/' . $flow->id);
        } else {
            $resSuccess = redirect()->back();
        }

        return $resSuccess->with('success', 'Data berhasil disimpan');
    }

    public function remove(Request $request, FlowChat $flow)
    {
        if ($request->ajax()) {
            if ($request->msg == 1) {
                $ar         = ActionReply::where('reply_message_id', $request->id)->orWhere('prompt_message_id', $request->id)->delete();
                $message    = Message::where('id', $request->id)->where('flow_chat_id', $flow->id)->delete();
            }
            if ($request->ar == 1) {
                $ar         = ActionReply::where('id', $request->id)->delete();
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
