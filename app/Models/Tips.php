<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    protected $fillable = [
        'bill_amount',
        'tip_percentage',
        'total_with_tip',
        'description',
    ];
}
