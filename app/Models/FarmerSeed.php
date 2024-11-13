<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerSeed extends Model
{
    use HasFactory;

    protected $fillable = ['farmer_id', 'season_id', 'seed_type', 'weight', 'price_per_kg', 'total_cost', 'is_paid', 'paid_amount', 'seed_date'];

    // A FarmerSeed belongs to a farmer
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    // A FarmerSeed belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
