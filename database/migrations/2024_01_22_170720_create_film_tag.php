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
        Schema::create('film_tag', function (Blueprint $table) {
            $table->id();
            //* Hacemos las llaves foraneas de id post y tag id y que lo borre en cascade
            $table -> foreignId('film_id') -> constrained() -> onDelete('cascade');
            $table -> foreignId('tag_id') -> constrained() -> onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_tag');
    }
};
