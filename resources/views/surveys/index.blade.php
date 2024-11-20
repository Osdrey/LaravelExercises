@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Encuestas</h1>
        <a href="{{ route('surveys.create') }}" class="btn btn-primary mb-3">Nueva Encuesta</a>
        @foreach ($surveys as $survey)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $survey->title }}</h5>
                <p class="card-text">{{ $survey->description }}</p>

                <!-- Botón para ver los detalles de la encuesta -->
                <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-primary">Ver</a>

                <!-- Botón para responder la encuesta-->
                <a href="{{ route('surveys.response', $survey->id) }}" class="btn btn-success">Responder</a>

                <!-- Botón para ver los resultados -->
                <a href="{{ route('surveys.results', $survey->id) }}" class="btn btn-info">Ver Resultados</a>
            </div>
        </div>
        @endforeach
@endsection


