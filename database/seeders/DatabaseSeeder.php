<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PenggunaSeeder::class,
            MateriSeeder::class,
            QuizSeeder::class,
            LokasiSeeder::class,
            InfoLokasiSeeder::class,
            // Tambah seeder lain di sini kalau ada
        ]);
    }
}
