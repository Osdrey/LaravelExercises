<?php

namespace App\Models\reservations;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    protected $table = 'topics';

    protected $fillable = ['name', 'description',  'class_id'];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
