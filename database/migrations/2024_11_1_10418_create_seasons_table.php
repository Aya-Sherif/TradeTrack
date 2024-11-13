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

        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Season name, e.g., "Beans Season"
            $table->date('start_date'); // Start date of the season
            $table->enum('status', ['active', 'inactive'])->default('active'); // Active or inactive status
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
