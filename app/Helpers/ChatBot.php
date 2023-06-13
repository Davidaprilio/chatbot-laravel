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

    static private function parseArgumentCondition(string $argument, Customer $customer)
    {
        if ($argument === 'null') return null;
        else if ($argument === 'true') return true;
        else if ($argument === 'false') return false;
        else if (is_numeric($argument) && Str::contains($argument, '.')) return (float) $argument;
        else if (is_numeric($argument)) return (int) $argument;
        else if (Str::startsWith($argument, 'customer.')) return $customer->{Str::replace('customer.', '', $argument)};
        return $argument;
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
        $message_text = Wa::parseMessage($message->text, $session->customer->toArray());
        $res = Wa::send($device, [
            'phone' => $phone,
            'message' => $message_text,
            'file_url' => $message->attachment,
        ]);
        try {
            $new_message = [
                'message_id' => $res['data']['messageid'],
                'reference_message_id' => $message->id,
                'from_me' => true,
                'text' => $message_text,
                'timestamp' => now()->timestamp,
                'type' => $message->type,
                'attachment' => $message->attachment,
            ];
            $session->chats()->create($new_message);
        } catch (\Throwable $th) {
            Log::error("Error on save message to database", [
                'message' => $new_message ?? null,
                'res' => $res ?? null,
                'error' => $th->getMessage()
            ]);
            throw $th;
        }

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
