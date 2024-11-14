<?php

namespace App\Models\Notes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id'];

    // Relación con la categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
