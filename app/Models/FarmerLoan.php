<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerLoan extends Model
{
    use HasFactory;

    protected $fillable = ['farmer_id', 'amount', 'loan_date', 'status'];

    // A FarmerLoan belongs to a farmer
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
