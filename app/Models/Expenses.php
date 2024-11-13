<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'amount', 'description', 'category_id', 'expense_date'];

    // Relación con la categoría
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
