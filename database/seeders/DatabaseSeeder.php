<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Server;
use App\Models\User;
use DavidArl\ApiDaerah\Database\Seeders\DaerahSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $simple_password = Hash::make('12345678');
        $user_dev = User::factory()->create([
            'name' => 'Developer',
            'username' => 'developer',
        ]);
        $user_admin = User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => $simple_password,
        ]);
        $user_demo = User::factory()->create([
            'name' => 'Demo',
            'username' => 'demo',
            'password' => $simple_password,
        ]);

        $server = Server::create([
            'name' => 'Server 1',
            'host' => 'http://103.167.35.210:7081',
            'apikey' => 'api-quods-2023-msd'
        ]);

        $server->devices()->create([
            'token' => 'dev_chat',
            'label' => 'Device Admin',
            'user_id' => $user_admin->id,
            'name' => 'Life4Win',
            'deviceless' => 'YxoQBkU8Oo',
        ]);
        $server->devices()->create([
            'token' => 'user2',
            'label' => 'Device Demo',
            'user_id' => $user_demo->id,
            'name' => 'Device 1',
            'deviceless' => 'YxoQBkU8Oo',
        ]);
        $server->devices()->create([
            'token' => '7nLJQ',
            'label' => 'Device 2',
            'user_id' => $user_admin->id,
            'name' => 'Device 2',
            'deviceless' => 'YxoQBkU8Oo',
        ]);

        $this->call([
            Demo1Seeder::class,
            DaerahSeeder::class
        ]);
    }
}
