@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $class->subject }}</h1>
        <p><strong>Hora de Inicio:</strong> {{ $class->start_time }}</p>
        <p><strong>Hora de Fin:</strong> {{ $class->end_time }}</p>

        <a href="{{ route('reservations.reservations.create', $class->id) }}" class="btn btn-primary">Reservar Clase</a>
    </div>
@endsection
