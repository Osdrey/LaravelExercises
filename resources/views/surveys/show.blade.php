@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $survey->title }}</h1>
        <p>{{ $survey->description }}</p>

        <h3>Preguntas</h3>
        <ul class="list-group mb-3">
            @foreach($survey->questions as $question)
                <li class="list-group-item">
                    <strong>{{ $question->question_text }}</strong>
                    <ul>
                        @foreach($question->options as $option)
                            <li>{{ $option->option_text }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>

        <!-- Agregar pregunta -->
        <h4>Añadir Pregunta</h4>
        <form action="{{ route('questions.store', $survey->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="question_text" class="form-label">Texto de la Pregunta</label>
                <input type="text" name="question_text" id="question_text" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Añadir Pregunta</button>
        </form>

        <!-- Agregar opciones a una pregunta -->
        @foreach($survey->questions as $question)
            <h4>Añadir Opciones a la Pregunta: {{ $question->question_text }}</h4>
            <form action="{{ route('options.store', $question->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="options" class="form-label">Opción</label>
                    <input type="text" name="options[]" id="options" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-secondary">Añadir Opción</button>
            </form>
        @endforeach
        <a href="{{ route('surveys.index') }}" class="btn btn-info">Regresar a la lista</a>
    </div>
@endsection
