<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends people
{
    use HasFactory;

    protected $fillable = ['season_id', 'from', 'to', 'fare', 'trip_date'];

    // A driver belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    // Additional methods specific to the Driver can be added here
}

