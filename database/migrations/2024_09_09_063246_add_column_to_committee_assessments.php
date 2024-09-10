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
        Schema::table('committee_assessments', function (Blueprint $table) {
            $table->foreignId('pillar_one_id')
                ->nullable()
                ->after('id')
                ->constrained('pillar_ones')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('pillar_one_question_one')->nullable()->after('pillar_one_id');
            $table->integer('pillar_one_question_two')->nullable()->after('pillar_one_question_one');
            $table->integer('pillar_one_question_three')->nullable()->after('pillar_one_question_two');
            $table->integer('pillar_one_question_four')->nullable()->after('pillar_one_question_three');
            $table->integer('pillar_one_question_five')->nullable()->after('pillar_one_question_four');

            $table->foreignId('pillar_two_id')
                ->nullable()
                ->after('pillar_one_question_five')
                ->constrained('pillar_twos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('pillar_two_question_one')->nullable()->after('pillar_two_id');
            $table->integer('pillar_two_question_two')->nullable()->after('pillar_two_question_one');
            $table->integer('pillar_two_question_three')->nullable()->after('pillar_two_question_two');
            $table->integer('pillar_two_question_four')->nullable()->after('pillar_two_question_three');
            $table->integer('pillar_two_question_five')->nullable()->after('pillar_two_question_four');

            $table->foreignId('pillar_three_id')
                ->nullable()
                ->after('pillar_two_question_five')
                ->constrained('pillar_threes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('pillar_three_question_one')->nullable()->after('pillar_three_id');
            $table->integer('pillar_three_question_two')->nullable()->after('pillar_three_question_one');
            $table->integer('pillar_three_question_three')->nullable()->after('pillar_three_question_two');
            $table->integer('pillar_three_question_four')->nullable()->after('pillar_three_question_three');
            $table->integer('pillar_three_question_five')->nullable()->after('pillar_three_question_four');
            $table->integer('pillar_three_question_six')->nullable()->after('pillar_three_question_five');

            $table->foreignId('pillar_four_id')
                ->nullable()
                ->after('pillar_three_question_six')
                ->constrained('pillar_fours')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('pillar_four_question_one')->nullable()->after('pillar_four_id');
            $table->integer('pillar_four_question_two')->nullable()->after('pillar_four_question_one');
            $table->integer('pillar_four_question_three')->nullable()->after('pillar_four_question_two');
            $table->integer('pillar_four_question_four')->nullable()->after('pillar_four_question_three');
            $table->integer('pillar_four_question_five')->nullable()->after('pillar_four_question_four');

            $table->foreignId('pillar_five_id')
                ->nullable()
                ->after('pillar_four_question_five')
                ->constrained('pillar_fives')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('pillar_five_question_one')->nullable()->after('pillar_five_id');
            $table->integer('pillar_five_question_two')->nullable()->after('pillar_five_question_one');
            $table->integer('pillar_five_question_three')->nullable()->after('pillar_five_question_two');
            $table->integer('pillar_five_question_four')->nullable()->after('pillar_five_question_three');
            $table->integer('pillar_five_question_five')->nullable()->after('pillar_five_question_four');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('committee_assessments', function (Blueprint $table) {
            //
        });
    }
};
