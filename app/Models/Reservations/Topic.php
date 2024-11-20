<?php

namespace App\Models\Reservations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'name', 'description'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
