<?php

namespace App\Http\Controllers;

use App\Helpers\Wa;
use App\Jobs\MakeSureStillChating;
use App\Models\ActionReply;
use App\Models\Chat;
use App\Models\ChatSession;
use App\Models\Customer;
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

        $this->Log->info('Hook Recived', $request->all());

        $inbox = $this->parseWhatsappCallback($request);
        $_cust = $this->getCustomer($request->phone, $request->name);
        
        $this->Log->info('Customer', $_cust);

        $session = ChatSession::firstOrCreate([
            'customer_id' => $_cust['customer']->id,
            'ended_at' => null,
        ]);

        $session->load('customer');

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
                $this->replyMsg($session, $message, $request->phone);
            }
            if ($_cust['customer']->name === null) {
                $messages = Message::hook('anon_customer')->sortMsg()->get();
                foreach ($messages as $msg) {
                    $this->replyMsg($session, $msg, $request->phone);
                }
                return true;
            }
        }
        // promt not answered
        else if ($promtNotAnswered) {
            $this->Log->info('Promt', [$promtNotAnswered]);

            $match_action_reply = self::getActionMatch($promtNotAnswered->reference_message_id, $request->message, $inbox);

            if ($match_action_reply && $match_action_reply->prompt_response !== '{!*}') {
                $this->Log->info('Promt Match', [$promtNotAnswered]);
                if ($promtNotAnswered->reference_message && $promtNotAnswered->reference_message->trigger_event == 'save_response') {
                    [$tableName, $columnName] = explode('.', $promtNotAnswered->reference_message->event_value);
                    $this->Log->info('collumn', [
                        'table' => $tableName,
                        'column' => $columnName
                    ]);
                    // DB::table($tableName)->update([
                    //     $columnName => $inbox->content
                    // ]);
                }
                $promtNotAnswered->update([
                    'response' => $request->message,
                ]);
                $this->replyMsg($session, $match_action_reply->replyMessage, $request->phone);
            } else {
                $this->Log->info('Promt Not Match', [$promtNotAnswered]);
                $this->replyMsg($session, new Message([
                    'text' => 'Maaf, pilihan tidak tersedia silahkan pilih menu yang tersedia',
                    'type' => 'chat',
                ]), $request->phone);
            }
        } else {
            $action_reply = ActionReply::where('type', 'auto_reply')->where('prompt_response', $request->message)->first();
            if ($action_reply) {
                $this->Log->info('Auto Reply Match', [$action_reply]);
                $this->replyMsg($session, $action_reply->replyMessage, $request->phone);
            } else {
                $this->Log->info('Auto Reply Not Match');
                $dont_understand_msg = Message::firstWhere('hook', 'dont_understand');
                if ($dont_understand_msg) {
                    $this->replyMsg($session, $dont_understand_msg, $request->phone);
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

    private function parseArgumentCondition(string $argumnet, Customer $customer)
    {
        if ($argumnet === 'null') return null;
        else if ($argumnet === 'true') return true;
        else if ($argumnet === 'false') return false;
        else if (is_numeric($argumnet) && str($argumnet)->contains('.')) return (float) $argumnet;
        else if (is_numeric($argumnet)) return (int) $argumnet;
        else if (str($argumnet)->startsWith('customer.')) return $customer->{str($argumnet)->replace('customer.', '')};
        return $argumnet;
    }

    protected function replyMsg(ChatSession $session, Message $message, string $phone)
    {
        if ($message->condition) {
            [$value1, $operator, $value2] = explode(' ', $message->condition);

            $value1 = $this->parseArgumentCondition($value1, $session->customer);
            $value2 = $this->parseArgumentCondition($value2, $session->customer);

            $macth = false;
            if($operator === '==' && $value1 === $value2) $macth = true;
            else if($operator === '>' && $value1 > $value2) $macth = true;
            else if($operator === '>=' && $value1 >= $value2) $macth = true;
            else if($operator === '<' && $value1 < $value2) $macth = true;
            else if($operator === '<=' && $value1 <= $value2) $macth = true;
            else if($operator === '!=' && $value1 != $value2) $macth = true;

            Log::info('Condition', [
                'value1' => $value1,
                'operator' => $operator,
                'value2' => $value2,
                'match' => $macth,
                'condition_type' => $message->condition_type
            ]);

            if ($message->condition_type === 'skip_to_message' && $macth) {
                return $this->replyMsg($session, Message::find($message->condition_value), $phone);
            }

        }

        $session->customer->refresh();
        $res = Wa::send([
            'phone' => $phone,
            'message' => Wa::parseMessage($message->text, $session->customer->toArray()),
        ]);
        $session->chat()->create([
            'message_id' => $res['data']['messageid'],
            'reference_message_id' => $message->id,
            'from_me' => true,
            'text' => $message->text,
            'timestamp' => now()->timestamp,
            'type' => $message->type,
        ]);

        if ($message->trigger_event === 'close_chat') {
            $session->update([
                'ended_at' => now()
            ]);
        }

        $this->Log->info('next_message', [$message->next_message]);
        if ($message->next_message) {
            $next_message = $message->getRelationValue('next_message');
            $this->Log->info('next_message', [
                $next_message
            ]);
            return $this->replyMsg($session, $next_message, $phone); 
        }

        if ($message->type === 'chat' && $message->hook == null && $message->trigger_event == null) {
            $end_of_menu_messeges = Message::hook('end_menu')->sortMsg()->get();
            foreach ($end_of_menu_messeges as $msg) {
                $this->replyMsg($session, $msg, $phone);
            }
            return true;
        }

        return true;
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
        $customer = Customer::find(1);
        dd(
            $this->parseArgumentCondition('true', $customer),
            $this->parseArgumentCondition('false', $customer),
            $this->parseArgumentCondition('null', $customer),
            $this->parseArgumentCondition('123', $customer),
            $this->parseArgumentCondition('1.3', $customer),
            $this->parseArgumentCondition('customer.nama', $customer),
            $this->parseArgumentCondition('customer.name', $customer),
            $this->parseArgumentCondition('customer.created_at', $customer),
        );
        $request = (object) [
            'message' => 'tidak'
        ];

        // dd(self::getActionMatch(5, $request->message));


        $msg = Message::find(11);
        if (!$msg instanceof Message) return false;

        return $msg->getRelationValue('next_message');
    }

    static public function getActionMatch(int|Message $promt_message,  ?string $keyword, object $inbox): ?ActionReply
    {
        $query = ActionReply::where('type', 'prompt_await')->where('prompt_message_id', is_int($promt_message) ? $promt_message : $promt_message->id);

        
        if(in_array($keyword, ['{*}', '{:location:}'])) {
            $action_reply = (clone $query)->where('prompt_response', '{!*}')->first();
            return $action_reply;
        }
        
        // casting
        if ($inbox->type === 'location') $keyword = '{:location:}';
        Log::info('inbox', [$inbox]);

        $action_reply = (clone $query)->where('prompt_response', $keyword)->first();
        if ($action_reply) return $action_reply;

        $action_replies = (clone $query)->where('prompt_response', 'like', '["%"]')->get();
        foreach ($action_replies as $reply) {
            $array = json_decode($reply->prompt_response);
            foreach ($array as $value) {
                if (strtolower($value) === strtolower($keyword)) {
                    return $reply;
                }
            }
        }
        
        $action_reply = (clone $query)->where('prompt_response', '{*}')->first();
        if ($action_reply) return $action_reply;

        $action_reply = (clone $query)->where('prompt_response', '{!*}')->first();
        return $action_reply;
    }
}
