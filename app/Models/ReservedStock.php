<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedStock extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'season_id', 'quantity', 'sale_price', 'reserved_date', 'status'];

    // A reserved stock belongs to a person (polymorphic relationship)
    public function person()
    {
        return $this->morphTo();
    }

    // Reserved stock belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
