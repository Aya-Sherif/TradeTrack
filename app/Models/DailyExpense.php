<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyExpense extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'season_id', 'expense_type', 'amount', 'expense_date', 'description'];

    // A daily expense belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // A daily expense belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
