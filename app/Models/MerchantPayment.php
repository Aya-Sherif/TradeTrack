<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantPayment extends Model
{
    use HasFactory;

    protected $fillable = ['updated','total_in_this_step','merchant_id', 'season_id', 'amount', 'payment_date', 'payment_type'];

    // A MerchantPayment belongs to a merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // A MerchantPayment belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
