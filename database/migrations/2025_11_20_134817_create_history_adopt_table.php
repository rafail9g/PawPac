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
        Schema::create('history_adopt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adopsi_id');
            $table->text('catatan')->nullable();
            $table->enum('status', ['lulus', 'tidak_lulus']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_adopt');
    }
};
