@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nueva Clase</h1>
        <form method="POST" action="{{ route('classes.store') }}">
            @csrf
            <div class="form-group">
                <label for="subject">Materia</label>
                <input type="text" name="subject" class="form-control" id="subject" required>
            </div>

            <div class="form-group">
                <label for="start_time">Hora de Inicio</label>
                <input type="time" name="start_time" class="form-control" id="start_time" required>
            </div>

            <div class="form-group">
                <label for="end_time">Hora de Fin</label>
                <input type="time" name="end_time" class="form-control" id="end_time" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar Clase</button>
        </form>
    </div>
@endsection
