<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantLoan extends Model
{
    use HasFactory;

    protected $fillable = ['merchant_id', 'amount', 'loan_date', 'status'];

    // A MerchantLoan belongs to a merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
