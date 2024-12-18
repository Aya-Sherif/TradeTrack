<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends People
{
    use HasFactory;

    protected $fillable = ['person_id', 'season_id', 'overtime_hours','daily_wage','created_at'];

    // Worker belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    // A worker can have many reserved stocks
    public function reservedStocks()
    {
        return $this->morphMany(ReservedStock::class, 'person');
    }

    // A worker has many work records
    // public function workRecords()
    // {
    //     return $this->hasMany(WorkerRecord::class);
    // }
}
