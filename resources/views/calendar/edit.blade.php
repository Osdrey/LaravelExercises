@extends('layouts.app')

@section('content')
    <h1>Editar Evento</h1>
    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Título:</label>
            <input type="text" name="title" id="title" value="{{ $event->title }}" required>
        </div>

        <div>
            <label for="description">Descripción:</label>
            <textarea name="description" id="description">{{ $event->description }}</textarea>
        </div>

        <div>
            <label for="start_time">Fecha de Inicio:</label>
            <input type="datetime-local" name="start_time" id="start_time" value="{{ $event->start_time->format('Y-m-d\TH:i') }}" required>
        </div>

        <div>
            <label for="end_time">Fecha de Fin:</label>
            <input type="datetime-local" name="end_time" id="end_time" value="{{ $event->end_time->format('Y-m-d\TH:i') }}" required>
        </div>

        <div>
            <label for="reminder">Recordatorio:</label>
            <input type="checkbox" name="reminder" id="reminder" {{ $event->reminder ? 'checked' : '' }}>
        </div>

        <button type="submit">Actualizar</button>
    </form>
@endsection
