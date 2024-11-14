@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservar Clase</h1>
        <form method="POST" action="{{ route('reservations.reservations.store') }}">
            @csrf

            <div class="form-group">
                <label for="class_id">Materia</label>
                <select name="class_id" id="class_id" class="form-control" required>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->subject }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="reservation_date">Fecha de Reserva</label>
                <input type="date" name="reservation_date" class="form-control" id="reservation_date" required>
            </div>

            <div class="form-group">
                <label for="start_time">Hora de Inicio</label>
                <input type="time" name="start_time" class="form-control" id="start_time" required>
            </div>

            <!-- Nuevos campos agregados -->
            <div class="form-group">
                <label for="user_name">Nombre de Usuario</label>
                <input type="text" name="user_name" class="form-control" id="user_name" required>
            </div>

            <div class="form-group">
                <label for="age">Edad</label>
                <input type="number" name="age" class="form-control" id="age" required>
            </div>

            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="tel" name="phone" class="form-control" id="phone" required>
            </div>

            <div class="form-group">
                <label for="education_level">Nivel Educativo</label>
                <input type="text" name="education_level" class="form-control" id="education_level" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>

            <button type="submit" class="btn btn-success">Confirmar Reserva</button>
        </form>
    </div>
@endsection
