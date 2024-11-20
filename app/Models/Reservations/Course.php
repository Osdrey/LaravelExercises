<?php

namespace App\Models\Reservations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'start_time', 'end_time', 'meet'];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
