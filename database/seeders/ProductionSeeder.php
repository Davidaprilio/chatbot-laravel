<?php

namespace Database\Seeders;

use App\Models\Kontak;
use App\Models\Role;
use App\Models\Server;
use App\Models\SettingWeb;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingWeb::create([
            'web_title' => 'ChatBot',
            'web_logo' => url('/logo-chat.png')
        ]);
        $role_super = Role::create([
            'slug' => 'sudo',
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
            'password' => Hash::make('dev3chatb0t')
        ])->assignRole($role_super->id);

        $user_admin = User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin123321'),
        ])->assignRole($role_admin->id);

        $user_demo = User::factory()->create([
            'name' => 'Demo',
            'username' => 'demo',
            'password' => Hash::make('12345678'),
        ])->assignRole($role_cust->id);

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
            DaerahSeeder::class
        ]);
    }
}
