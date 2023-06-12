<?php

namespace Database\Seeders;

use App\Models\ActionReply;
use App\Models\FlowChat;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Demo2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        
        $flow_chat = FlowChat::create([
            'name' => 'Flow 2',
            'active' => 1,
        ]);

        $messages = [
            [// 0
                'hook' => 'welcome',
                'text' => 'Selamat datang di chatbot
                || layanan otomatis kami',
                'next_message' => 3
            ]
        ];


        foreach ($messages as $message) {
            $message['text'] = parseText($message['text']);
            Message::create(array_merge($message, [
                'flow_chat_id' => $flow_chat->id
            ]));
        }

        $action_replies = [
        ];

        foreach ($action_replies as $action_reply) {
            ActionReply::create($action_reply);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
