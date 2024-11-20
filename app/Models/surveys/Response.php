<?php

namespace App\Models\surveys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'question_id',
        'option_id',
    ];

    // Relación con la encuesta
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    // Relación con la pregunta
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relación con la opción seleccionada
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
