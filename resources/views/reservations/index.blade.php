@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Historial de Reservas</h1>

        <!-- Filtro para Materias -->
        <form method="GET" action="{{ route('reservations.index') }}" id="filter-form">
            <div class="form-group">
                <label for="course_id">Filtrar por Materia</label>
                <select name="course_id" id="course_id" class="form-control" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('course_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->subject }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Tabla de Reservas -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Tema</th>
                    <th>Fecha de Reserva</th>
                    <th>Hora de Inicio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->course->subject }}</td>
                        <td>{{ $reservation->topics->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i') }}</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                        <td>

                            <!-- Botón de Cancelar (Formulario DELETE) -->
                            @if($reservation->status === 'pending')
                                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres cancelar esta reserva?')">Cancelar</button>
                                </form>
                            @endif

                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info">Ver Más</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('reservations.create') }}" class="btn btn-primary">Reservar Clase</a>
    </div>
@endsection
