<?php

namespace App\Http\Controllers\surveys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\surveys\Survey;
use App\Models\surveys\Question;
use App\Models\surveys\option;

class QuestionController extends Controller
{
    // Crear nueva pregunta para una encuesta
    public function store(Request $request, $surveyId)
    {
        $survey = Survey::findOrFail($surveyId);

        $question = $survey->questions()->create([
            'question_text' => $request->question_text
        ]);

        return redirect()->route('surveys.show', $surveyId);
    }

    // Crear opciones para una pregunta
    public function addOptions(Request $request, $questionId)
    {
        $question = Question::findOrFail($questionId);

        foreach ($request->options as $optionText) {
            $question->options()->create([
                'option_text' => $optionText
            ]);
        }

        return redirect()->route('surveys.show', $question->survey_id);
    }
}
