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
        //
        Schema::table('pillar_threes', function (Blueprint $table) {
            $table->string('question_five', 1000)->change();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('pillar_threes', function (Blueprint $table) {
            $table->string('question_five', 255)->change();
        });               
    }
};
