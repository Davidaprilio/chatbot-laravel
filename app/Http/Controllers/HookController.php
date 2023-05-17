<?php

namespace App\Http\Controllers;

use App\Helpers\Wa;
use App\Models\ActionReply;
use App\Models\Chat;
use App\Models\ChatSession;
use App\Models\Customer;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HookController extends Controller
{
    protected $Log;

    public function __construct()
    {
        $this->Log = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/hook.log'),
        ]);
    }

    public function callback(Request $request)
    {
        $this->Log->info('Hook Recived', $request->all());

        $_cust = $this->getCustomer($request->phone, $request->name);
        
        $this->Log->info('Customer', $_cust);

        $session = ChatSession::firstOrCreate([
            'customer_id' => $_cust['customer']->id,
            'ended_at' => null,
        ]);

        $session->chat()->create([
            'message_id' => $request->id,
            'from_me' => 0,
            'text' => $request->message,
            'type' => 'chat',
            'timestamp' => $request->timestamp,
        ]);

        $promtNotAnswered = $session->chat()->where('from_me', 1)->orderBy('id', 'desc')->where('type', 'prompt')->where('response', null)->first();

        // create response message kirim menu
        if ($session->chat()->count() == 1) {
            $messages = Message::where('hook', 'welcome')->get();
            foreach ($messages as $message) {
                $this->replyMsg($session, $request, $message);
            }
        }
        // promt not answered
        else if ($promtNotAnswered) {
            $this->Log->info('Promt', [$promtNotAnswered]);

            $action_reply = ActionReply::where('type', 'prompt_await')->where('prompt_message_id', $promtNotAnswered->reference_message_id)->where('prompt_response', $request->message)->first();

            if ($action_reply) {
                $this->Log->info('Promt Match', [$promtNotAnswered]);
                $promtNotAnswered->update([
                    'response' => $request->message,
                ]);
                $this->replyMsg($session, $request, $action_reply->replyMessage);
            } else {
                $this->Log->info('Promt Not Match', [$promtNotAnswered]);
                $this->replyMsg($session, $request, new Message([
                    'text' => 'Maaf, pilihan tidak tersedia silahkan pilih menu yang tersedia',
                    'type' => 'chat',
                ]));
            }
        } else {
            $action_reply = ActionReply::where('type', 'auto_reply')->where('prompt_response', $request->message)->first();
            if ($action_reply) {
                $this->Log->info('Auto Reply Match', [$action_reply]);
                $this->replyMsg($session, $request, $action_reply->replyMessage);
            } else {
                $this->Log->info('Auto Reply Not Match', [$action_reply]);
                $this->replyMsg($session, $request, new Message([
                    'text' => 'Maaf, saya tidak mengerti maksud anda',
                    'type' => 'chat',
                ]));
                $this->replyMsg($session, $request, Message::find(2));
            }
        }


        $this->Log->info('Session', [$session, $promtNotAnswered]);

        return response()->json([
            'success' => true,
        ]);
    }

    protected function getHookMessageType(Customer $customer)
    {
        
        
    }

    protected function replyMsg(ChatSession $session, Request $request, Message $message)
    {
        $res = Wa::send([
            'phone' => $request->phone,
            'message' => $message->text,
        ]);
        $session->chat()->create([
            'message_id' => $res['data']['messageid'],
            'reference_message_id' => $message->id,
            'from_me' => true,
            'text' => $message->text,
            'timestamp' => now()->timestamp,
            'type' => $message->type,
        ]);
    }


    /**
     * @return array<bool,Customer>
     */
    protected function getCustomer(string $phone, string $pushname)
    {
        $Customer = Customer::firstOrCreate([
            'phone' => $phone,
        ], [
            'pushname' => $pushname,
        ]);
        
        if ($Customer->pushname != $pushname) {
            $Customer->pushname = $pushname;
            $Customer->save();
        }

        return [
            'is_new' => $Customer->created_at->isToday(),
            'customer' => $Customer
        ];
    }

    public function test(Request $request)
    {
        return ActionReply::where('type', 'prompt_await')->where('prompt_message_id', 2)->where('prompt_response', '3')->first();
    }
}
