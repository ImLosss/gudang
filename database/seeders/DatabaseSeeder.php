<?php

namespace Database\Seeders;

use App\Models\Distributor;
use App\Models\Type;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            PermissionRoleSeeder::class,
            UserSeeder::class,
            MerekSeeder::class,
            TypeSeeder::class,
            DistributorSeeder::class,
            BarangSeeder::class,
            BarangMasukSeeder::class

        ]);
    }
}
