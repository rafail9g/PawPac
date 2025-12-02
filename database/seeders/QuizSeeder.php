<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuizSoal;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('quiz_soal')->insert([

            [
                'pertanyaan' => 'Mengapa Anda ingin mengadopsi kucing?',
                'opsi_a' => null,
                'opsi_b' => null,
                'opsi_c' => null,
                'opsi_d' => null,
                'tipe_soal' => 'isian',
                'jawaban_benar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pertanyaan' => 'Berapa jumlah kucing yang Anda pelihara saat ini?',
                'opsi_a' => null,
                'opsi_b' => null,
                'opsi_c' => null,
                'opsi_d' => null,
                'tipe_soal' => 'isian',
                'jawaban_benar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pertanyaan' => 'Apakah Anda tinggal di rumah atau kos?',
                'opsi_a' => 'Rumah',
                'opsi_b' => 'Kos',
                'opsi_c' => 'Apartemen',
                'opsi_d' => 'Lainnya',
                'tipe_soal' => 'pg',
                'jawaban_benar' => 'A', // contoh
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
