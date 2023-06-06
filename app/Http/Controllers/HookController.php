<?php

namespace App\Http\Controllers;

use App\Helpers\ChatBot;
use App\Helpers\Wa;
use App\Jobs\MakeSureStillChating;
use App\Models\ActionReply;
use App\Models\Chat;
use App\Models\ChatSession;
use App\Models\Customer;
use App\Models\Device;
use App\Models\FlowChat;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HookController extends Controller
{
    protected $Log;

    public function __construct()
    {
        $this->Log = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/hook.log'),
            // 'level' => 'alert',
        ]);
    }

    public function parseWhatsappCallback(Request $request)
    {
        $inbox =  (object) [
            'type' => 'text',
            'content' => '',
        ];
        if (in_array($request->type, ['extendedTextMessage', 'conversation'])) {
            $inbox->type = 'text';
            $inbox->content = $request->message;
        } else if (in_array($request->type, ['locationMessage'])) {
            $inbox->type = 'location';
            $inbox->content = "{$request->payload['message']['locationMessage']['degreesLatitude']},{$request->payload['message']['locationMessage']['degreesLongitude']}";
        } else {
        }

        return $inbox;
    }

    public function callback(Request $request)
    {
        if ($request->fromMe) return true;
        if (strpos($request->phone, '@g.us') > 0) return false; // skip group

        $device = Device::with('flow_chat')->token($request->token)->first();
        if ($device === null) {
            return $this->Log->alert("Hook Recived - with device '{$request->token}' not found");
        }
        if ($device->flow_chat === null) {
            return $this->Log->alert("Hook Recived - with flow_chat not found in device '{$device->token}'", [
                'device' => $device,
                'request' => $request->all(),
            ]);
        }
        $flow = $device->flow_chat;
        if (!($flow instanceof FlowChat)) {
            Log::info("Flow not Instance with FlowChat Model");
            return false;
        }
        $this->Log->info('Hook Recived - OK', [
            'device' => $device,
            'request' => $request->all(),
        ]);

        $inbox = $this->parseWhatsappCallback($request);
        $_cust = $this->getCustomer($request->phone, $request->name);

        $this->Log->info('Customer', $_cust);

        $session = ChatSession::firstOrCreate([
            'customer_id' => $_cust['customer']->id,
            'device_id' => $device->id,
            'phone_device' => $request->server_phone,
            'ended_at' => null,
        ]);

        $session->load('customer');

        $session->chats()->create([
            'message_id' => $request->id,
            'from_me' => 0,
            'text' => $request->message,
            'type' => 'chat',
            'timestamp' => $request->timestamp,
        ]);

        $promtNotAnswered = $session->chats()->where('from_me', 1)->orderBy('id', 'desc')->where('type', 'prompt')->where('response', null)->first();
        // create response message kirim menu
        if ($session->chats()->count() == 1) {
            $messages = $flow->messages()->where('hook', 'welcome')->get();
            foreach ($messages as $message) {
                ChatBot::replyMsg($device, $session, $message, $request->phone);
            }
            if ($_cust['customer']->name === null) {
                $messages = $flow->messages()->hook('anon_customer')->sortMsg()->get();
                foreach ($messages as $msg) {
                    ChatBot::replyMsg($device, $session, $msg, $request->phone);
                }
                return true;
            }
        }
        // promt not answered
        else if ($promtNotAnswered) {
            $this->Log->info('Promt', [$promtNotAnswered]);

            [$match_action_reply, $result_data] = self::getActionMatch($promtNotAnswered->reference_message_id, $request->message, $inbox);

            if ($match_action_reply && $match_action_reply->prompt_response !== '{!*}') {
                $this->Log->info('Promt Match', [$promtNotAnswered]);

                if ($promtNotAnswered->reference_message && $promtNotAnswered->reference_message->trigger_event == 'save_response') {
                    
                    $columns_name= explode('.', $promtNotAnswered->reference_message->event_value);

                    Log::info('Columns Name',[$columns_name]);

                    if ($columns_name[0] === 'data') {
                        $result_data['more_data'] = array_merge($_cust['customer']->more_data->toArray(), [
                            $columns_name[1] => $request->message,
                        ]);
                    } else {
                        $result_data[$columns_name[0]] = $request->message;
                    }
                }

                if (count($result_data) > 0) {
                    $_cust['customer']->update($result_data);
                }

                $promtNotAnswered->update([
                    'response' => $request->message,
                ]);
                ChatBot::replyMsg($device, $session, $match_action_reply->replyMessage, $request->phone);
            } else {
                $this->Log->info('Promt Not Match', [$promtNotAnswered]);
                ChatBot::replyMsg($device, $session, new Message([
                    'text' => 'Maaf, jawaban anda tidak sesuai dengan pertanyaan sebelumnya. Mohon jawab dengan benar.',
                    'type' => 'chat',
                    'next_message' => null
                ]), $request->phone);
            }
        } else {
            $action_reply = ActionReply::where('type', 'auto_reply')->where('prompt_response', $request->message)->first();
            if ($action_reply) {
                $this->Log->info('Auto Reply Match', [$action_reply]);
                ChatBot::replyMsg($device, $session, $action_reply->replyMessage, $request->phone);
            } else {
                $this->Log->info('Auto Reply Not Match');
                $dont_understand_msg = $flow->messages()->firstWhere('hook', 'dont_understand');
                if ($dont_understand_msg) {
                    ChatBot::replyMsg($device, $session, $dont_understand_msg, $request->phone);
                }
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


    /**
     * @return array<bool,Customer>
     */
    protected function getCustomer(string $phone, string $pushname)
    {
        $Customer = Customer::firstOrCreate([
            'phone' => $phone,
        ], [
            'pushname' => $pushname,
            'more_data' => []
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
        $c = Customer::first();
        dd(
            $c,
            $c->more_data
        );
        $msg = Message::find(11);
        if (!$msg instanceof Message) return false;

        return $msg->getRelationValue('next_message');
    }

    static public function getActionMatch(int|Message $promt_message,  ?string $keyword, object $inbox): array
    {
        $query = ActionReply::where('type', 'prompt_await')->where('prompt_message_id', is_int($promt_message) ? $promt_message : $promt_message->id);


        if (in_array($keyword, ['{*}', '{:location:}'])) {
            $action_reply = (clone $query)->where('prompt_response', '{!*}')->first();
            return [$action_reply, ['value' => false]];
        }

        // casting
        if ($inbox->type === 'location') $keyword = '{:location:}';
        Log::info('inbox', [$inbox]);

        $action_reply = (clone $query)->where('prompt_response', $keyword)->first();
        if ($action_reply) return [$action_reply, ['value' => $keyword]];

        $action_replies = (clone $query)->where('prompt_response', 'like', '["%"]')->get();
        foreach ($action_replies as $reply) {
            $array = json_decode($reply->prompt_response);
            foreach ($array as $textFormat) {
                // jika $textFormat terdapat karakter { dan } atau ** atau *{ atau }* maka dianggap variable
                $is_variable = preg_match('/\{.*\}|\*\*|\*\{|\}\*/', $textFormat);
                Log::info('is_variable', [
                    'is_variable' => $is_variable,
                    'textFormat' => $textFormat,
                ]);
                if ($is_variable) {
                    $variables = getVariableOnText($keyword, $textFormat);
                    if ($variables) {
                        return [$reply, $variables];
                    }
                } else {
                    if (strtolower($textFormat) === strtolower($keyword)) {
                        return [$reply, ['value' => $keyword]];
                    }
                }
            }
        }

        $action_reply = (clone $query)->where('prompt_response', '{*}')->first();
        if ($action_reply) return [$action_reply, ['value' => $keyword]];

        $action_reply = (clone $query)->where('prompt_response', '{!*}')->first();
        return [$action_reply, ['value' => false]];
    }   
}
