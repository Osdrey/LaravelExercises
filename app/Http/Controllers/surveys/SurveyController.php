<?php

namespace App\Http\Controllers\surveys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\surveys\Survey;
use App\Models\surveys\Question;
use App\Models\surveys\Response;

class SurveyController extends Controller
{
    // Mostrar la lista de encuestas
    public function index()
    {
        $surveys = Survey::all();
        return view('surveys.index', compact('surveys'));
    }

    // Crear nueva encuesta
    public function create()
    {
        return view('surveys.create');
    }

    // Almacenar la encuesta en la base de datos
    public function store(Request $request)
    {
        $survey = Survey::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('surveys.show', $survey->id);
    }

    // Mostrar encuesta y las preguntas asociadas
    public function show($id)
    {
        $survey = Survey::with('questions')->findOrFail($id);
        return view('surveys.show', compact('survey'));
    }

    // Método para ver los resultados de la encuesta
    public function showResults($surveyId)
    {
        // Recuperamos la encuesta junto con las preguntas y opciones
        $survey = Survey::with('questions.options')->findOrFail($surveyId);

        // Obtenemos las respuestas para cada pregunta
        $results = [];

        foreach ($survey->questions as $question) {
            $results[$question->id] = [];

            foreach ($question->options as $option) {
                $count = Response::where('question_id', $question->id)
                    ->where('option_id', $option->id)
                    ->count();
                $results[$question->id][$option->id] = [
                    'option_text' => $option->option_text,
                    'count' => $count,
                ];
            }
        }

        // Pasar los resultados a la vista
        return view('surveys.results', compact('survey', 'results'));
    }
}
