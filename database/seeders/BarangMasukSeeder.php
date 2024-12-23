<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BarangMasuk;

class BarangMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BarangMasuk::create([
            'id_distributor' => 1,
            'id_user' => 2,
            'id_barang' => 1,
            'jumlah_masuk' => 3
        ]);
    }
}
