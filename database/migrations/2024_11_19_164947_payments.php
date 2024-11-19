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
        //
        // In a migration file:
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade'); // Reference to `people` table
            $table->decimal('amount', 10, 2); // Amount paid
            $table->enum('role', ['worker', 'driver']); // Role of the person being paid
            $table->timestamp('paid_at')->useCurrent(); // When payment was made
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
