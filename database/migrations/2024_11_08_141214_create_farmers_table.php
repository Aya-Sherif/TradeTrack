<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');



    // Create Farmers table - stores basic information for each farmer
    Schema::create('farmers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone')->nullable();
        $table->decimal('account_balance', 10, 2)->default(0); // Farmer's overall balance
        $table->timestamps();
    });

    // Create Farmer Seeds table - tracks seeds provided to farmers
    Schema::create('farmer_seeds', function (Blueprint $table) {
        $table->id();
        $table->foreignId('farmer_id')->constrained('farmers')->onDelete('cascade'); // Link to farmer
        $table->unsignedBigInteger('season_id'); // Explicitly set to unsignedBigInteger
        $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade'); // Link to season
        $table->string('seed_type'); // Type of seed
        $table->decimal('weight', 8, 2); // Seed weight in kg
        $table->decimal('price_per_kg', 10, 2); // Price per kg
        $table->decimal('total_cost', 10, 2); // Total cost for seeds
        $table->boolean('is_paid')->default(false); // Indicates if payment is complete
        $table->decimal('paid_amount', 10, 2)->default(0); // Partial payment amount
        $table->date('seed_date'); // Date seeds were taken
        $table->timestamps();
    });

    // Create Farmer Loans table - records cash loans taken by farmers
    Schema::create('farmer_loans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('farmer_id')->constrained('farmers')->onDelete('cascade');
        $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade'); // Link to season
        $table->decimal('amount', 10, 2); // Loan amount
        $table->date('loan_date'); // Date of the loan
        $table->timestamps();
    });

    // Create Farmer Supplies table - records crops supplied by the farmer
    Schema::create('farmer_supplies', function (Blueprint $table) {
        $table->id();
        $table->foreignId('farmer_id')->constrained('farmers')->onDelete('cascade');
        $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade'); // Link to season
        $table->string('crop_type'); // Type of crop
        $table->decimal('weight', 8, 2); // Crop weight in kg
        $table->decimal('price_per_kg', 10, 2); // Price per kg for the crop
        $table->decimal('total_payment', 10, 2); // Total payment due for the crop
        $table->decimal('paid_amount', 10, 2)->default(0); // Partial payment amount for crop
        $table->date('supply_date'); // Date of crop supply
        $table->timestamps();
    });

    // Re-enable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
}

public function down()
{
    Schema::dropIfExists('farmer_supplies');
    Schema::dropIfExists('farmer_loans');
    Schema::dropIfExists('farmer_seeds');
    Schema::dropIfExists('farmers');
    Schema::dropIfExists('seasons');
}

};
