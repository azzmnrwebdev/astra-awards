<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('jury_assessments', 'start_assessments');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('start_assessments', 'jury_assessments');
    }
};
