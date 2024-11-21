<?php

namespace App\Models\chronometer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chronometer extends Model
{
    use HasFactory;

    protected $fillable = ['total_time', 'status', 'started_at'];

    public function laps()
    {
        return $this->hasMany(Lap::class);
    }
}
