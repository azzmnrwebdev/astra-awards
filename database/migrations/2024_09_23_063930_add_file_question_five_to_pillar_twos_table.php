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
        Schema::table('pillar_twos', function (Blueprint $table) {
            $table->integer('file_question_five')->nullable()->after('file_question_four');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pillar_twos', function (Blueprint $table) {
            //
        });
    }
};
