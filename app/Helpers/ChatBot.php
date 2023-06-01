<?php

namespace App\Helpers;

use App\Helpers\Wa;
use App\Models\ChatSession;
use App\Models\Customer;
use App\Models\Device;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatBot
{
    
    static function LOG()
    {
        return Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/hook.log'),
            // 'level' => 'alert',
        ]);
    }

    static private function parseArgumentCondition(string $argumnet, Customer $customer)
    {
        if ($argumnet === 'null') return null;
        else if ($argumnet === 'true') return true;
        else if ($argumnet === 'false') return false;
        else if (is_numeric($argumnet) && Str::contains('.', $argumnet)) return (float) $argumnet;
        else if (is_numeric($argumnet)) return (int) $argumnet;
        else if (Str::startsWith('customer.', $argumnet)) return $customer->{Str::replace('customer.', '', $argumnet)};
        return $argumnet;
    }

    static function replyMsg(Device $device, ChatSession $session, Message $message, string $phone)
    {
        if ($message->condition) {
            [$value1, $operator, $value2] = explode(' ', $message->condition);

            $value1 = self::parseArgumentCondition($value1, $session->customer);
            $value2 = self::parseArgumentCondition($value2, $session->customer);

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
                return self::replyMsg($device, $session, Message::find($message->condition_value), $phone);
            }
        }

        $session->customer->refresh();
        $res = Wa::send($device, [
            'phone' => $phone,
            'message' => Wa::parseMessage($message->text, $session->customer->toArray()),
        ]);
        $session->chats()->create([
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

        self::LOG()->info('next_message', [$message->next_message]);
        if ($message->next_message) {
            $next_message = $message->getRelationValue('next_message');
            self::LOG()->info('next_message', [
                $next_message
            ]);
            return self::replyMsg($device, $session, $next_message, $phone); 
        }

        if ($message->type === 'chat' && $message->hook == null && $message->trigger_event == null) {
            $end_of_menu_messeges = Message::hook('end_menu')->sortMsg()->get();
            foreach ($end_of_menu_messeges as $msg) {
                self::replyMsg($device, $session, $msg, $phone);
            }
            return true;
        }

        return true;
    }
}
