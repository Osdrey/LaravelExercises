@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Responder Encuesta: {{ $survey->title }}</h1>

<form action="{{ route('surveys.response', $survey->id) }}" method="POST">
        @csrf

        @foreach ($survey->questions as $question)
            <div class="mb-3">
                <label class="form-label">{{ $question->question_text }}</label>

                @foreach ($question->options as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="responses[{{ $question->id }}]" value="{{ $option->id }}" id="option{{ $option->id }}">
                        <label class="form-check-label" for="option{{ $option->id }}">
                            {{ $option->option_text }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Enviar Respuestas</button>
    </form>
</div>
@endsection
