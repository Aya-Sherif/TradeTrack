<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->foreignId('merchant_id')->constrained('merchants')->onDelete('cascade'); // Merchant reference
            $table->string('type'); // 'payment' or 'transaction'
            $table->date('date'); // The date of the activity
            $table->decimal('amount', 10, 2)->nullable(); // Amount for payments
            $table->decimal('weight', 8, 2)->nullable(); // Weight for transactions
            $table->decimal('price_per_kg', 10, 2)->nullable(); // Price per kg for transactions
            $table->decimal('total_price', 10, 2)->nullable(); // Total price for transactions
            $table->string('payment_type')->nullable(); // For payment type
            $table->tinyInteger('updated')->default(0); // Use 0 for false instead of 'false'
            $table->integer('total_in_this_step')->default(0);
            $table->text('description')->nullable(); // Description (for payments or transactions)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
}
