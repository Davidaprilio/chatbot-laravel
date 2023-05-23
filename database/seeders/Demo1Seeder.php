<?php

namespace Database\Seeders;

use App\Models\ActionReply;
use App\Models\FlowChat;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Demo1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $flow_chat = FlowChat::create([
            'name' => 'Flow 1',
            'active' => 1,
        ]);

        $messages = [
            [
                'hook' => 'welcome',
                'text' => 'Selamat datang di chatbot
                || layanan otomatis kami',
                'next_message' => 3
            ],
            [
                
                'text' => 'sebelum lanjut, bisa beri tahu nama anda?',
                'type' => 'prompt',
                'trigger_event' => 'save_response',
                'event_value' => 'customers.name',
                'order_sending' => 1,
            ],
            [
                'condition' => 'customer.name != null',
                'condition_type' => 'skip_to_message',
                'condition_value' => 5,
                // 'hook' => 'anon_customer',
                'text' => 'Perkenalkan saya adalah Chatbot Pesan Otomatis yang akan melayani anda',
                'next_message' => 2
            ],
            [
                'text' => 'baik saya akan panggil anda [name], apakah iya?',
                'type' => 'prompt',
            ],
            [// 5
                'text' => 'baik [name] ada yang bisa saya bantu?',
                'next_message' => 8
            ],
            [
                'type' => 'prompt',
                'text' => 'baik ketikkan nama anda saja!',
                'trigger_event' => 'save_response',
                'event_value' => 'customers.name',
            ],
            [
                'text' => 'baik [name] ada yang bisa saya bantu?',
            ],
            [ // 8
                'type' => 'prompt',
                'text' => 'Menu:
                || 1. Menu lainya
                || 2. Info saya
                || 3. Gak jadi
                ',
            ],
            [
                'text' => 'Maaf saya tidak mengerti bisa dijawab iya atau tidak saja',
            ],
            [ // 10
                'text' => 'Maaf saya tidak mengerti bisa dijawab iya atau tidak saja',
            ],
            [
                'type' => 'prompt',
                'text' => 'Menu Lainya: 
                || 1. Info Produk
                || 2. Jadwal Toko
                || 3. Kembali
                ',
            ],
            [
                'text' => 'Hai kak berikut infonya:
                || nama: [name]
                || status: member',
                'next_message' => 19
            ],
            [
                'type' => 'prompt',
                'text' => 'Baik kak, jika ada pertanyaan lain bisa hubungi disini ya, apakah ingin ditutup?',
            ],
            [
                'trigger_event' => 'close_chat',
                'text' => 'Terimakasih telah menghubungi kami dan selamat [_time]',
            ],
            [ // 15
                'text' => 'Info Produk: 
                || balbalbablabalbal..',
                'next_message' => 11
            ],
            [
                'text' => 'Jadwal Toko: 
                || balbalbablabalbal..',
                'next_message' => 11
            ],
            [
                'text' => 'Baik kak [nama], pilih yang mana?',
                'next_message' => 8
            ],
            [
                'hook' => 'dont_understand',
                'text' => 'maaf saya tidak mengerti maksud anda coba pilih menu ini',
                'next_message' => 8
            ],
            [
                'type' => 'prompt',
                'text' => 'Ada yang bisa dibantu lagi?',
            ],
            [ // 20
                'hook' => 'dont_understand',
                'text' => 'maaf saya tidak mengerti maksud anda coba pilih menu ini',
                'next_message' => 8
            ],
            [
                'text' => 'Baik kak bisa pilih menu ini ya',
                'next_message' => 8
            ],
            [
                'type' => 'prompt',
                'text' => 'Untuk pendataan bisa kirimkan lokasi anda saat ini kak [name]
                || menggunakan share lokasi whatsapp!',
                'trigger_event' => 'save_response',
                'event_value' => 'customers.location',
            ],
            [
                'text' => 'Terimakasih telah memberi lokasi kak [name]',
                'next_message' => 5
            ],
            [
                'text' => 'maaf kak [name] tolong kirimkan lokasi kakak dengan shareloc wa',
            ],
        ];




        foreach ($messages as $message) {
            $message['text'] = parseText($message['text']);
            Message::create(array_merge($message, [
                'flow_chat_id' => $flow_chat->id
            ]));
        }

        $action_replies = [
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 22,
                'prompt_response' => '{:location:}', // match with sharlock
                'reply_message_id' => 5,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 22,
                'prompt_response' => '{!*}',
                'reply_message_id' => 24,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 2,
                'prompt_response' => '{*}', // match all response
                'reply_message_id' => 4,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 4,
                'prompt_response' => '["iya", "boleh", "oke", "baik", "y", "ya"]', // match available options response
                'reply_message_id' => 22 , // 5 - 22
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 4,
                'prompt_response' => '["tidak", "tak", "panggil {value}**", "{value} saja"]', // match available options response with format
                'reply_message_id' => 6,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 4,
                'prompt_response' => '{!*}', // not match all response
                'reply_message_id' => 9,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 19,
                'prompt_response' => '{!*}', // not match all response
                'reply_message_id' => 9,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 6,
                'prompt_response' => "{*}", // match all response
                'reply_message_id' => 5,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 8,
                'prompt_response' => "1",
                'reply_message_id' => 11,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 8,
                'prompt_response' => "2",
                'reply_message_id' => 12,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 8,
                'prompt_response' => "3",
                'reply_message_id' => 13,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 13,
                'prompt_response' => '["iya", "boleh", "oke", "baik", "y", "ya"]',
                'reply_message_id' => 14,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 13,
                'prompt_response' => '["tidak", "tak", "gak jadi", "tutup aja"]',
                'reply_message_id' => 17,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 19,
                'prompt_response' => '["iya", "boleh", "oke", "baik", "y", "ya"]',
                'reply_message_id' => 21,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 19,
                'prompt_response' => '["tidak", "tak", "gak jadi", "udak kak"]',
                'reply_message_id' => 13,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 19,
                'prompt_response' => 'tutup aja',
                'reply_message_id' => 14,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 11,
                'prompt_response' => '1',
                'reply_message_id' => 15,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 11,
                'prompt_response' => '2',
                'reply_message_id' => 16,
            ],
            [
                'type' => 'prompt_await',
                'prompt_message_id' => 11,
                'prompt_response' => '3',
                'reply_message_id' => 8,
            ],
        ];

        foreach ($action_replies as $action_reply) {
            ActionReply::create($action_reply);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
