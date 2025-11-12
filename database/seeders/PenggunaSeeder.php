<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\pengguna;


DB::table('pengguna')->insert([
    [
        'name' => 'Administrator',
        'email' => 'admin@catadopt.com',
        'password' => Hash::make('password123'), // ✅ sudah di-hash!
        'role' => 'admin',
        'address' => 'Jember',
        'phone' => '08123456789',
        'living_environment' => 'Rumah dengan lingkungan aman untuk kucing.',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Calon Adopter',
        'email' => 'adopter@catadopt.com',
        'password' => Hash::make('password'),
        'role' => 'adopter',
        'address' => 'Lumajang',
        'phone' => '081298765432',
        'living_environment' => 'Kost sederhana dengan ruang yang memadai.',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Penyedia Kucing',
        'email' => 'provider@catadopt.com',
        'password' => Hash::make('password'),
        'role' => 'provider',
        'address' => 'Banyuwangi',
        'phone' => '082112233445',
        'living_environment' => 'Rumah luas dengan area bermain kucing.',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);
