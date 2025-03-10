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
        Schema::create('jury_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presentation_id')
                ->constrained('presentations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('presentation_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jury_assessments');
    }
};
