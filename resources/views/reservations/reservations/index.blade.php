@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Historial de Reservas</h1>

        <form method="GET" action="{{ route('reservations.reservations.index') }}" id="filter-form">
            <div class="form-group">
                <label for="class_id">Filtrar por Materia</label>
                <select name="class_id" id="class_id" class="form-control">
                    <option value="">Todas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->subject }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Fecha de Reserva</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->class->subject }}</td>
                        <td>{{ $reservation->reservation_date }}</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                        <td>
                            @if($reservation->status != 'completada' && $reservation->status != 'cancelada')
                                <a href="{{ route('reservations.reservations.edit', $reservation->id) }}" class="btn btn-warning">Editar</a>
                            @endif
                            <a href="{{ route('reservations.reservations.show', $reservation->id) }}" class="btn btn-info">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('classes.create') }}" class="btn btn-success">Crear Materia</a>
        <a href="{{ route('reservations.reservations.create') }}" class="btn btn-primary">Reservar Clase</a>
    </div>
@endsection
