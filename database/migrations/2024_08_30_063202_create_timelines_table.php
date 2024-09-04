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
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->date('start_registration')->nullable();
            $table->date('end_registration')->nullable();
            $table->date('start_form')->nullable();
            $table->date('end_form')->nullable();
            $table->date('start_selection')->nullable();
            $table->date('end_selection')->nullable();
            $table->date('start_initial_assessment')->nullable();
            $table->date('end_initial_assessment')->nullable();
            $table->date('start_final_assessment')->nullable();
            $table->date('end_final_assessment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
