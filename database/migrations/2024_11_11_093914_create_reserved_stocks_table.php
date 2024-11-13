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

        // Create reserved_stock table to store items reserved by people (e.g., farmers, merchants)
        Schema::create('reserved_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade'); // Reference to the person (could be farmer, merchant, etc.)
            $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade'); // Link to season
            $table->decimal('quantity', 10, 2); // Quantity of the reserved item (in kg or units)
            $table->decimal('sale_price', 10, 2)->nullable(); // Sale price will be added once sold
            $table->date('reserved_date'); // Date the item was reserved
            $table->enum('status', ['reserved', 'sold'])->default('reserved'); // Status to track if the item is reserved or sold
            $table->timestamps(); // Created and updated timestamps
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Corrected the table name to 'reserved_stock'
        Schema::dropIfExists('reserved_stock');
    }
};
