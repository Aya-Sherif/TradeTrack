<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends People
{
    use HasFactory;

    // A farmer has many loans
    public function loans()
    {
        return $this->hasMany(FarmerLoan::class);
    }

    // A farmer has many seeds (FarmerSeeds)
    public function seeds()
    {
        return $this->hasMany(FarmerSeed::class);
    }

    // A farmer has many supplies (FarmerSupplies)
    public function supplies()
    {
        return $this->hasMany(FarmerSupply::class);
    }

    // A farmer can have many reserved stocks
    public function reservedStocks()
    {
        return $this->morphMany(ReservedStock::class, 'person');
    }
}

