@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resultados de la Encuesta: {{ $survey->title }}</h1>

    @foreach ($survey->questions as $question)
        <div class="mb-3">
            <h3>{{ $question->question_text }}</h3>

            <ul>
                @foreach ($question->options as $option)
                    <li>
                        <strong>{{ $option->option_text }}:</strong>
                        {{ $results[$question->id][$option->id]['count'] }} respuestas
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
