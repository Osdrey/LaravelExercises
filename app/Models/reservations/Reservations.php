<?php

namespace App\Models\reservations;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'class_id',
        'user_name',
        'age',
        'phone',
        'education_level',
        'email',
        'reservation_date',
        'status'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
