<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('kucing', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('provider_id');
        $table->string('name');
        $table->integer('age');
        $table->string('breed');
        $table->text('description');
        $table->string('image')->nullable();
        $table->enum('status', ['available', 'adopted'])->default('available');
        $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('kucings');
    }
};
