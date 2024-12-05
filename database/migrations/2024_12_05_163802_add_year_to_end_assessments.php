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
            $table->string('year')->nullable()->after('presentation_value_pillar_five');
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
