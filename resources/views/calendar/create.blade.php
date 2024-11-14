@extends('layouts.app')

@section('content')
    <h1>Crear Evento</h1>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Título:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="description">Descripción:</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div>
            <label for="start_time">Fecha de Inicio:</label>
            <input type="datetime-local" name="start_time" id="start_time" required>
        </div>

        <div>
            <label for="end_time">Fecha de Fin:</label>
            <input type="datetime-local" name="end_time" id="end_time" required>
        </div>

        <div>
            <label for="reminder">Recordatorio:</label>
            <input type="checkbox" name="reminder" id="reminder" value="1">
        </div>

        <button type="submit">Guardar</button>
    </form>
@endsection
