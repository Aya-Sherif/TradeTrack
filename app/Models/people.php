<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class people extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role', 'account_balance'];

    // Define polymorphic relationship for reserved stock
    public function reservedStocks()
    {
        return $this->morphMany(ReservedStock::class, 'person');
    }
}
