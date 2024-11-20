@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles de la Reserva</h1>

        <!-- Información de la reserva -->
        <p><strong>Materia:</strong> {{ $reservation->course->subject }}</p>
        <p><strong>Fecha de Reserva:</strong> {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}</p>
        <p><strong>Hora de Inicio:</strong> {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i') }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($reservation->status) }}</p>

        <!-- Detalles de la clase (incluyendo el tema) -->
        <h3>Detalles de la Clase</h3>
        <p><strong>Tema:</strong> {{ $reservation->topics->name ?? 'No asignado' }}</p>
        <p><strong>Descripción:</strong> {{ $reservation->course->description ?? 'No disponible' }}</p>

        <!-- Enlace para unirse a la reunión -->
        <h3>Reunión</h3>
        @if($reservation->course->meet_link)
            <p><strong>Enlace:</strong> <a href="{{ $reservation->course->meet_link }}" target="_blank" class="btn btn-primary">Unirse a la Reunión</a></p>
        @else
            <p>No hay enlace disponible para la reunión.</p>
        @endif

        <a href="{{ route('reservations.index') }}" class="btn btn-secondary mt-3">Volver al Historial de Reservas</a>
    </div>
@endsection
