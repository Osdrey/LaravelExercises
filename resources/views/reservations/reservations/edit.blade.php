@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Reserva</h1>

        <form method="POST" action="{{ route('reservations.reservations.update', $reservation->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="reservation_date">Fecha de Reserva</label>
                <input type="date" name="reservation_date" class="form-control" id="reservation_date" value="{{ $reservation->reservation_date }}" required>
            </div>

            <div class="form-group">
                <label for="start_time">Hora de Inicio</label>
                <input type="time" name="start_time" class="form-control" id="start_time" value="{{ $reservation->start_time }}" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </form>
    </div>
@endsection
