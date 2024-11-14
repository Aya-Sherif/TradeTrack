<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPayment extends Model
{
    use HasFactory;

    protected $fillable = ['updated','total_in_this_step','company_id', 'company_transaction_id', 'payment_amount', 'payment_method', 'payment_date'];

    // A company payment belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // A company payment belongs to a company transaction
    public function companyTransaction()
    {
        return $this->belongsTo(CompanyTransaction::class);
    }
}
