<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'account_balance'];

    // A company has many transactions
    public function transactions()
    {
        return $this->hasMany(CompanyTransaction::class);
    }

    // A company has many payments
    public function payments()
    {
        return $this->hasMany(CompanyPayment::class);
    }
}
