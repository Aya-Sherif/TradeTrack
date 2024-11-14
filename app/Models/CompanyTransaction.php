<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['updated','total_in_this_step','transaction_date','company_id', 'season_id', 'weight', 'price_per_kg', 'total_cost'];

    // A company transaction belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // A company transaction belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    // A company transaction can have many payments
    public function payments()
    {
        return $this->hasMany(CompanyPayment::class);
    }
}
