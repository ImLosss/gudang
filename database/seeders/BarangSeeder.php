<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Barang::create([
            'nama' => 'Oli Samping',
            'stok' => 10,
            'id_merek' => 1,
            'id_type' => 1,
            'foto' => 'fotoku.jpg'
        ]);

        Barang::create([
            'nama' => 'Oli Motul',
            'stok' => 10,
            'id_merek' => 1,
            'id_type' => 1,
            'foto' => 'fotoku.jpg'
        ]);
    }
}
