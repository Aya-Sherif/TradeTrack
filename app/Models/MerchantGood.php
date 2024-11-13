<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantGood extends Model
{
    use HasFactory;

    protected $fillable = ['merchant_id', 'season_id', 'weight', 'price_per_kg', 'total_price', 'date'];

    // A MerchantGood belongs to a merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // A MerchantGood belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
