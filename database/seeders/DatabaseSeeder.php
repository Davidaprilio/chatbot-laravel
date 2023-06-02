<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Klinik;
use App\Models\Kontak;
use App\Models\Role;
use App\Models\Server;
use App\Models\SettingWeb;
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
        SettingWeb::create([
            'web_title' => 'ChatBot',
            'web_logo' => url('/logo-chat.png')
        ]);
        $role_super = Role::create([
            'slug' => 'super-admin',
            'name' => 'Super Admin',
            'description' => 'Super Admin',
        ]);
        $role_admin = Role::create([
            'slug' => 'admin',
            'name' => 'Admin',
            'description' => 'Admin',
        ]);
        $role_cust = Role::create([
            'slug' => 'customer',
            'name' => 'Customer',
            'description' => 'Customer',
        ]);
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

        Kontak::init($user_dev->id);
        Kontak::init($user_admin->id);
        Kontak::init($user_demo->id);

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
