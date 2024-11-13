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
    {Schema::create('daily_expenses', function (Blueprint $table) {
        $table->id();
        $table->string('expense_type'); // Type of the expense (e.g., transportation, materials, etc.)
        $table->decimal('amount', 10, 2); // Amount spent
        $table->date('expense_date'); // Date of the expense
        $table->string('payment_method'); // Payment method (e.g., cash, bank transfer, etc.)
        $table->text('description')->nullable(); // Additional details or description about the expense
        $table->timestamps(); // Timestamps for created and updated times
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_expenses');
    }
};
