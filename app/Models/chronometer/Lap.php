<?php

namespace App\Models\chronometer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lap extends Model
{
    use HasFactory;

    protected $fillable = ['chronometer_id', 'lap_time'];

    public function chronometer()
    {
        return $this->belongsTo(Chronometer::class);
    }
}
