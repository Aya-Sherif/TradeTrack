<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends People
{
    use HasFactory;

    // A merchant has many goods (MerchantGoods)
    public function merchantGoods()
    {
        return $this->hasMany(MerchantGood::class);
    }

    // A merchant has many payments (MerchantPayments)
    public function merchantPayments()
    {
        return $this->hasMany(MerchantPayment::class);
    }

    // A merchant has many loans (MerchantLoans)
    public function merchantLoans()
    {
        return $this->hasMany(MerchantLoan::class);
    }

    // A merchant can have many reserved stocks
    public function reservedStocks()
    {
        return $this->morphMany(ReservedStock::class, 'person');
    }
}
