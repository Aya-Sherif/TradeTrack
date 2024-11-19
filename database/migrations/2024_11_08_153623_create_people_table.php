<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Create the people table to store worker and driver data
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the worker or driver
            $table->enum('role', ['worker', 'driver']); // Define if they are a worker or driver
            $table->decimal('account_balance', 10, 2)->default(0); // Accumulated wages or fare
            $table->timestamps();
        });

        // Create workers table, which references the people table
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade'); // Reference to `people` table
            $table->unsignedBigInteger('season_id'); // Explicitly set to unsignedBigInteger
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade'); // Link to season            $table->date('work_date'); // Work date
            $table->decimal('daily_wage', 8, 2); // Daily wage
            $table->decimal('overtime_hours', 5, 2)->nullable(); // Overtime hours, nullable
            $table->timestamps();
        });

        // Create drivers table, which also references the people table
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade'); // Reference to `people` table
            $table->unsignedBigInteger('season_id'); // Explicitly set to unsignedBigInteger
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade'); // Link to season            $table->string('from'); // Starting location of the trip
            $table->string(column: 'start_from'); // Destination of the trip
            $table->string(column: 'to'); // Destination of the trip
            $table->decimal('fare', 8, 2); // Trip fare
            $table->date('trip_date'); // Date of trip
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('workers');
        Schema::dropIfExists('people');
    }
};
