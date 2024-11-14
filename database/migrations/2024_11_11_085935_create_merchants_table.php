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

        // Create merchants table to store merchant data
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the merchant
            $table->decimal('account_balance', 10, 2)->default(0); // Account balance
            $table->timestamps();
        });

        // Create merchant_goods table to store goods data linked to merchants
        Schema::create('merchant_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('merchants')->onDelete('cascade'); // Reference to merchants
            $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade'); // Link to seasons table
            $table->integer('weight'); // Weight of goods
            $table->integer('price_per_kg'); // Price per kg of goods
            $table->integer('total_price'); // Total price of the goods
            $table->tinyInteger('updated')->default(0); // Use 0 for false instead of 'false'

            $table->date('date'); // Date when the goods were added
            $table->timestamps();
        });

        // Create merchant_payments table to store payments made by merchants
        Schema::create('merchant_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('merchants')->onDelete('cascade'); // Reference to merchants
            $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade'); // Link to seasons table
            $table->decimal('amount', 10, 2); // Payment amount

            $table->date('payment_date'); // Date of payment
            $table->enum('payment_type', ['نقدي', 'تحويل بنك'])->comment('نوع الدفع (نقدي أو تحويل بنك)');
            $table->tinyInteger('updated')->default(0); // Use 0 for false instead of 'false'
            $table->text('description')->nullable(); // Optional additional details about the payment
            $table->timestamps();
        });

        // Create merchant_loans table to store loan details for merchants
        Schema::create('merchant_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('merchants')->onDelete('cascade'); // Reference to merchants
            $table->decimal('amount', 10, 2); // Loan amount
            $table->date('loan_date'); // Date of loan
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid'); // Loan status (unpaid or paid)
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop all related tables
        Schema::dropIfExists('merchant_loans');
        Schema::dropIfExists('merchant_payments');
        Schema::dropIfExists('merchant_goods');
        Schema::dropIfExists('merchants');
    }
};
