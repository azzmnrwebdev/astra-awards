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
        Schema::create('system_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pillar_one_id')
                ->nullable()
                ->constrained('pillar_ones')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('pillar_one_question_one')->nullable();
            $table->integer('pillar_one_question_two')->nullable();
            $table->integer('pillar_one_question_three')->nullable();
            $table->integer('pillar_one_question_four')->nullable();
            $table->integer('pillar_one_question_five')->nullable();
            $table->foreignId('pillar_two_id')
                ->nullable()
                ->constrained('pillar_twos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('pillar_two_question_one')->nullable();
            $table->integer('pillar_two_question_two')->nullable();
            $table->integer('pillar_two_question_three')->nullable();
            $table->integer('pillar_two_question_four')->nullable();
            $table->integer('pillar_two_question_five')->nullable();
            $table->foreignId('pillar_three_id')
                ->nullable()
                ->constrained('pillar_threes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('pillar_three_question_one')->nullable();
            $table->integer('pillar_three_question_two')->nullable();
            $table->integer('pillar_three_question_three')->nullable();
            $table->integer('pillar_three_question_four')->nullable();
            $table->integer('pillar_three_question_five')->nullable();
            $table->integer('pillar_three_question_six')->nullable();
            $table->foreignId('pillar_four_id')
                ->nullable()
                ->constrained('pillar_fours')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('pillar_four_question_one')->nullable();
            $table->integer('pillar_four_question_two')->nullable();
            $table->integer('pillar_four_question_three')->nullable();
            $table->integer('pillar_four_question_four')->nullable();
            $table->integer('pillar_four_question_five')->nullable();
            $table->foreignId('pillar_five_id')
                ->nullable()
                ->constrained('pillar_fives')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('pillar_five_question_one')->nullable();
            $table->integer('pillar_five_question_two')->nullable();
            $table->integer('pillar_five_question_three')->nullable();
            $table->integer('pillar_five_question_four')->nullable();
            $table->integer('pillar_five_question_five')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_assessments');
    }
};
