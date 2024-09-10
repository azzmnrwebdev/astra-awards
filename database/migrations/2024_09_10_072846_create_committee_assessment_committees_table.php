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
        Schema::create('committee_assessment_committees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_assessment_id')
                ->constrained('committee_assessments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('committee_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_assessment_committees');
    }
};
