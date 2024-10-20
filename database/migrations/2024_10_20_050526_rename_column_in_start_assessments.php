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
        Schema::table('start_assessments', function (Blueprint $table) {
            $table->renameColumn('presentation_file', 'presentation_file_pillar_one');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('start_assessments', function (Blueprint $table) {
            $table->renameColumn('presentation_file', 'presentation_file_pillar_one');
        });
    }
};
