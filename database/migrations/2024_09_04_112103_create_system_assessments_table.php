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
