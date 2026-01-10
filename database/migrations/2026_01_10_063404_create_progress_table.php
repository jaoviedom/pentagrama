<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->string('world'); // 'sol' o 'fa'
            $table->integer('level');
            $table->integer('stars')->default(0);
            $table->boolean('is_completed')->default(false);
            $table->integer('best_score')->default(0);
            $table->timestamps();

            $table->unique(['player_id', 'world', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
