<?php

namespace App\Models\surveys;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['title', 'description'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
