@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reserva Detalles</h1>

        <p><strong>Materia:</strong> {{ $reservation->class->subject }}</p>
        <p><strong>Fecha de Reserva:</strong> {{ $reservation->reservation_date }}</p>
        <p><strong>Hora de Inicio:</strong> {{ $reservation->start_time }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($reservation->status) }}</p>

        <!-- Enlace para ver más detalles de la clase -->
        <a href="{{ route('classes.show', $reservation->class->id) }}" class="btn btn-info">Ver Detalles de la Materia</a>
    </div>
@endsection
