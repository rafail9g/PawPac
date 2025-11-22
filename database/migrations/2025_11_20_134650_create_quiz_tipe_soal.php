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
        Schema::table('quiz_soal', function (Blueprint $table) {
            $table->enum('tipe', ['pg', 'isian'])->default('pg');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
