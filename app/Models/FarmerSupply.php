<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerSupply extends Model
{
    use HasFactory;

    protected $fillable = ['farmer_id', 'season_id', 'crop_type', 'weight', 'price_per_kg', 'total_payment', 'paid_amount', 'supply_date'];

    // A FarmerSupply belongs to a farmer
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    // A FarmerSupply belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
