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
        $this->call([
            ProductionSeeder::class,
            Demo1Seeder::class,
        ]);
    }
}
