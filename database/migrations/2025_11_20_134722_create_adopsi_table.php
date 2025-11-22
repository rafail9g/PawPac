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
        Schema::create('adopsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adopter_id');
            $table->unsignedBigInteger('kucing_id');
            $table->integer('nilai_quiz')->nullable();
            $table->enum('status', ['pending', 'lulus', 'tidak_lulus'])->default('pending');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adopsi');
    }
};
