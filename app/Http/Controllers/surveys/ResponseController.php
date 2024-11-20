<?php

namespace App\Http\Controllers\surveys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\surveys\Survey;
use App\Models\surveys\Response;

class ResponseController extends Controller
{
    // Mostrar el formulario de respuestas
    public function create($surveyId)
    {
        $survey = Survey::with('questions.options')->findOrFail($surveyId); // Obtener la encuesta con preguntas y opciones
        return view('surveys.response', compact('survey'));
    }

    // Guardar las respuestas del usuario
    public function store(Request $request, $surveyId)
    {
        // Validar las respuestas (asegurar que cada respuesta sea una opción válida)
        $validated = $request->validate([
            'responses.*' => 'required|exists:options,id', // Cada respuesta debe ser una opción válida
        ]);

        // Guardar las respuestas en la base de datos
        foreach ($validated['responses'] as $questionId => $optionId) {
            Response::create([
                'survey_id' => $surveyId,
                'question_id' => $questionId,
                'option_id' => $optionId,
            ]);
        }

        return redirect()->route('surveys.index')->with('success', 'Respuestas enviadas con éxito');
    }
}
