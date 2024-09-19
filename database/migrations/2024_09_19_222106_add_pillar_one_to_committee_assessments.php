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
            $table->integer('pillar_one_question_six')->nullable()->after('pillar_one_question_five');
            $table->integer('pillar_one_question_seven')->nullable()->after('pillar_one_question_six');
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
