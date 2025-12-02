<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('quiz_soal', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');

            // Untuk pilihan ganda (opsional kalau tipe isian)
            $table->string('opsi_a')->nullable();
            $table->string('opsi_b')->nullable();
            $table->string('opsi_c')->nullable();
            $table->string('opsi_d')->nullable();

            // "pilihan" atau "isian"
            $table->enum('tipe_soal', ['pg', 'isian'])->default('pg');

            // Untuk pilihan ganda → jawaban_benar adalah huruf A,B,C,D
            // Untuk isian → jawaban_benar adalah string jawaban
            $table->string('jawaban_benar')->nullable();

            // Untuk menilai isian pakai keyword (opsional)
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_soal');
    }
};
