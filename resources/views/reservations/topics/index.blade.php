@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Temas Disponibles</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Clase</th>
                    <th>Tema</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topics as $topic)
                    <tr>
                        <td>{{ $topic->class->subject }}</td>
                        <td>{{ Str::limit($topic->name, 30) }}</td>
                        <td>
                            <a href="{{ route('reservations.topics.show', $topic->id) }}" class="btn btn-info">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('reservations.topics.create') }}" class="btn btn-primary">Crear Tema</a>
    </div>
@endsection
