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

        // Create companies table to store company data
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the company
            $table->integer('account_balance')->default(0); // Account balance to track payments and credits
            $table->timestamps();
        });

        // Create company_transactions table to store transactions related to companies
        Schema::create('company_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade'); // Reference to companies table
            $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade'); // Link to seasons table
            $table->decimal('weight', 8, 2); // Weight of the product in kg
            $table->integer('price_per_kg'); // Price per kilogram
            $table->integer('total_cost'); // Total cost (weight * price_per_kg)
            $table->tinyInteger('updated')->default(0); // Use 0 for false instead of 'false'

            $table->date('transaction_date'); // Date of transaction

            $table->timestamps();
        });

        // Create company_payments table to store payments made by companies
        Schema::create('company_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade'); // Reference to companies table
            $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade'); // Link to seasons table
            $table->integer('payment_amount'); // Amount paid
            $table->enum('payment_method', ['نقدي', 'تحويل بنك']); // Payment method (cash or bank_transfer)
            $table->tinyInteger('updated')->default(0); // Use 0 for false instead of 'false'
            $table->date('payment_date'); // Date of payment
            $table->timestamps();

        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the company_payments, company_transactions, and companies tables in reverse order
        Schema::dropIfExists('company_payments');
        Schema::dropIfExists('company_transactions');
        Schema::dropIfExists('companies');
    }
};
