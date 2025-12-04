<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoLokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('info_lokasi')->insert([
            [
                'alamat' => 'Jl. KH. Shiddiq Jember, Jawa Timur',
                'no_hp' => '08986361089',
                'jam_buka' => '08:00:00',
                'jam_tutup' => '17:00:00',
            ],
        ]);
    }
}
