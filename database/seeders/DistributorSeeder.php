<?php

namespace Database\Seeders;

use App\Models\Distributor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Distributor::create([
            'nama' => 'PT Sukaria',
            'alamat' => 'sukaria',
            'notelp' => '081242634183',
        ]);
    }
}
