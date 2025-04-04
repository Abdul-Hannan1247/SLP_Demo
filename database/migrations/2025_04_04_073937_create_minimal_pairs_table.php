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
        Schema::create('minimal_pairs', function (Blueprint $table) {
            $table->id();
            $table->string('word1');
            $table->string('word2');
            $table->string('image1_path');
            $table->string('image2_path');
            $table->string('audio1_path');
            $table->string('audio2_path');
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minimal_pairs');
    }
};
