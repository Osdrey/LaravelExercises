@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Clases Disponibles</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                    <tr>
                        <td>{{ $class->subject }}</td>
                        <td>{{ $class->start_time }}</td>
                        <td>{{ $class->end_time }}</td>
                        <td>
                            <a href="{{ route('reservations.classes.show', $class->id) }}" class="btn btn-info">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('reservations.classes.create') }}" class="btn btn-primary">Crear Clase</a>
    </div>
@endsection
