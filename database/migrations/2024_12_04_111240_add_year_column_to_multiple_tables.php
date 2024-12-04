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
        Schema::table('pillar_ones', function (Blueprint $table) {
            $table->string('year')->nullable()->after('mosque_id');
        });

        Schema::table('pillar_twos', function (Blueprint $table) {
            $table->string('year')->nullable()->after('mosque_id');
        });

        Schema::table('pillar_threes', function (Blueprint $table) {
            $table->string('year')->nullable()->after('mosque_id');
        });

        Schema::table('pillar_fours', function (Blueprint $table) {
            $table->string('year')->nullable()->after('mosque_id');
        });

        Schema::table('pillar_fives', function (Blueprint $table) {
            $table->string('year')->nullable()->after('mosque_id');
        });

        Schema::table('presentations', function (Blueprint $table) {
            $table->string('year')->nullable()->after('mosque_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pillar_ones', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('pillar_twos', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('pillar_threes', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('pillar_fours', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('pillar_fives', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('presentations', function (Blueprint $table) {
            $table->dropColumn('year');
        });
    }
};
