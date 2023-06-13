<?php

namespace Database\Seeders;

use App\Models\ActionReply;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'hook' => 'welcome',
                'text' => 'Selamat datang di chatbot',
            ],
            [
                'type' => 'prompt',
                'hook' => 'welcome',
                'text' => 'Silahkan pilih menu
                ||1. Ucapan terima kasih
                ||2. Layanannya apa saja
                ||3. Menu 3
                ||4. Menu 4',
            ],
            [
                'text' => 'Terima kasih telah menghubungi kami',
            ],
            [
                'type' => 'prompt',
                'text' => 'Berikut layanan yang kami sediakan:
                ||1. Layanan 1
                ||2. Layanan 2
                ||3. Layanan 3
                ||4. Tidak jadi
                ||
                ||Silahkan pilih layanan yang anda inginkan',
            ],
            [
                'text' => 'Layanan 1
                || layanan 1 ini adalah layanan 1 yang sangat bagus',
            ],
            [
                'text' => 'Layanan 2
                || layanan 2 ini adalah layanan 2 yang sangat bagus',
            ],
            [
                'text' => 'Layanan 3
                || layanan 3 ini adalah layanan 3 yang sangat bagus',
            ],
            [
                'text' => 'Terima kasih telah menggunakan layanan kami',
            ],
            [
                'text' => 'Menu 3
                || menu 3 ini adalah menu 3 yang sangat bagus',
            ],
            [
                'text' => 'Menu 4
                || menu 4 ini adalah menu 4 yang sangat bagus',
            ],
            [
                'text' => 'Iya pak ada yang bisa kami bantu
                || berikut menu yang bapak bisa pilih',
                'next_message' => 2
            ],
            [
                'type' => 'prompt',
                'trigger_event' => 'save_response',
                'event_value' => 'customers:name',
                'text' => 'baik dengan siapa? tolong tuliskan namanya',
            ],
            [
                'hook' => 'dont_understand',
                'text' => 'maaf saya tidak mengerti maksud anda',
                'next_message' => 2
            ]
        ];

        foreach ($messages as $message) {
            $message['text'] = parseText($message['text']);
            Message::create($message);
        }

        $action_replies = [
            [
                'type' => 'prompt_await', // diambil saat ada prompt yang belum dijawab
                'prompt_message_id' => 2, // prompt message id yang belum dijawab
                'prompt_response' => '1', // response yang men-trigger action ini
                'reply_message_id' => 3, // reply message id yang akan dikirim
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 2,
                'prompt_response' => '2',
                'reply_message_id' => 4,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 2,
                'prompt_response' => '3',
                'reply_message_id' => 9,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 2,
                'prompt_response' => '4',
                'reply_message_id' => 10,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 4,
                'prompt_response' => '1',
                'reply_message_id' => 5,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 4,
                'prompt_response' => '2',
                'reply_message_id' => 6,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 4,
                'prompt_response' => '3',
                'reply_message_id' => 7,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 4,
                'prompt_response' => '4',
                'reply_message_id' => 2,
            ],
            [
                'type' => 'auto_reply',
                'prompt_response' => 'halo',
                'reply_message_id' => 11,
            ],
            [
                'type' => 'auto_reply',
                'prompt_response' => 'oke',
                'reply_message_id' => 8,
            ],
            [
                'type' => 'auto_reply',
                'prompt_response' => 'terimakasih',
                'reply_message_id' => 8,
            ],
        ];

        foreach ($action_replies as $action_reply) {
            ActionReply::create($action_reply);
        }
    }
}
