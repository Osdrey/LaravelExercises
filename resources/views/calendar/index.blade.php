@extends('layouts.app')

@section('content')
    <h1>Calendario de Eventos</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary">Crear Nuevo Evento</a>

    <ul>
        @foreach ($events as $event)
            <li>
                <strong>{{ $event->title }}</strong> ({{ $event->start_time }} - {{ $event->end_time }})
                <a href="{{ route('events.edit', $event->id) }}">Editar</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
