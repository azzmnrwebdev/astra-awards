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
        Schema::create('pillar_twos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mosque_id')
                ->constrained('mosques')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('question_one')->nullable();
            $table->json('question_two')->nullable();
            $table->json('question_three')->nullable();
            $table->json('question_four')->nullable();
            $table->json('question_five')->nullable();
            $table->text('file_question_two')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pillar_twos');
    }
};
