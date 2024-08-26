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
        Schema::create('pillar_threes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mosque_id')
                ->constrained('mosques')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('question_one')->nullable();
            $table->string('question_two')->nullable();
            $table->string('question_three')->nullable();
            $table->string('question_four')->nullable();
            $table->string('question_five')->nullable();
            $table->string('question_six')->nullable();
            $table->text('file_question_one')->nullable();
            $table->text('file_question_four')->nullable();
            $table->text('file_question_six')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pillar_threes');
    }
};
