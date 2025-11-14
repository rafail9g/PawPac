<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        Materi::create([
            'judul' => 'Cara Memandikan Kucing dengan Aman',
            'isi' => 'Gunakan air hangat dan sampo khusus kucing. Hindari area telinga dan mata agar tidak iritasi.',
            'kategori' => 'Perawatan Dasar',
        ]);

        Materi::create([
            'judul' => 'Tips Menyisir Bulu Kucing Agar Tidak Rontok',
            'isi' => 'Sisir bulu kucing setiap hari menggunakan sisir logam bergigi jarang untuk mengurangi kerontokan.',
            'kategori' => 'Perawatan Bulu',
        ]);
    }
}

