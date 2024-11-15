<?php

namespace App\Models\recipes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'ingredients', 'prep_time', 'cook_time',
        'difficulty', 'meal_type', 'diet_type', 'category'
    ];
}
