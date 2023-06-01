<?php

namespace App\Console\Commands;

use App\Helpers\ChatBot;
use App\Models\ChatSession;
use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AutoEndSessionChat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-end-session-chat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Otomatis mengakhiri sesi chat yang sudah lama tidak aktif';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // ambil chat session yang ended_at nya null dan relasinya dengan chat cari chat yang paling baru sekitar 1 jam dan ambil relasi chat terakhir

        $chat_sessions = ChatSession::whereNull('ended_at')
            ->whereHas('chat', function ($query) {
                $query->where('from_me', 0)->where('created_at', '<', now()->subHour()); // 1 jam
            })
            ->with(['chat' => function ($query) {
                $query->where('from_me', 0)->latest()->first();
            }])
            ->get();
      
            // dd($chat_sessions);
        
        foreach ($chat_sessions as $session) {
            $device = $session->device;
            if ($session->alert_close == 0) {
                $message = Message::where('hook', 'confirm_not_response')->where('flow_chat_id', $device->flow_chat_id)->first();
                if ($message === null) {
                    continue;
                }
                Log::info("Chat Confirm Ended - {$session->id} - {$session->customer->phone}");
            } else if ($session->alert_close == 1) {
                $message = Message::where('hook', 'close_chat_not_response')->where('flow_chat_id', $device->flow_chat_id)->first();
                if ($message === null) {
                    continue;
                }
                Log::info("Chat Ended - {$session->id} - {$session->customer->phone}");
                $session->ended_at = now();
            } else {
                Log::info("Chat Ended - {$session->id} - {$session->customer->phone}");
                continue;
            }

            $session->alert_close = $session->alert_close + 1;
            $session->save();

            ChatBot::replyMsg($device, $session, $message, $session->customer->phone);
        }

        Log::info('Auto End Session Chat - OK');
    }
}
