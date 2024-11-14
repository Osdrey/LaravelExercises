<?php

namespace App\Models\reservations;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    protected $fillable = ['subject', 'start_time', 'end_time'];

    public function topics()
    {
        return $this->hasMany(Topics::class, 'class_id');
    }
}
