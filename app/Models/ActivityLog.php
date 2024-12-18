<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // Define the table for this model
    protected $table = 'activity_logs';

    // Mass assignable attributes
    protected $fillable = [
        'item_id',
        'temp_id',
        'type',
        'date',
        'amount',
        'weight',
        'price_per_kg',
        'total_price',
        'payment_type',
        'description',
        'updated',
        'total_in_this_step'
    ];

    // Relationship with Merchant model
    // public function merchant()
    // {
    //     return $this->belongsTo(Merchant::class);
    // }
}
