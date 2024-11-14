<?php

namespace App\Models\Notes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Cambiar el nombre de la tabla
    protected $table = 'notecategories';

    protected $fillable = ['name'];
}
