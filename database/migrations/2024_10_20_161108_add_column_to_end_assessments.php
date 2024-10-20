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
        Schema::table('end_assessments', function (Blueprint $table) {
            $table->integer('presentation_value_pillar_two')->nullable()->after('presentation_value_pillar_one');
            $table->integer('presentation_value_pillar_three')->nullable()->after('presentation_value_pillar_two');
            $table->integer('presentation_value_pillar_four')->nullable()->after('presentation_value_pillar_three');
            $table->integer('presentation_value_pillar_five')->nullable()->after('presentation_value_pillar_four');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('end_assessments', function (Blueprint $table) {
            //
        });
    }
};
