@extends('layouts.app')

@section('content')
    <h1>Calculadora de Propinas - Listado de Cálculos</h1>
    <a href="{{ route('tips.create') }}">Crear Nuevo Cálculo</a>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Monto de la Cuenta</th>
                <th>Porcentaje de Propina</th>
                <th>Total con Propina</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calculations as $calculation)
                <tr>
                    <td>{{ $calculation->id }}</td>
                    <td>{{ $calculation->bill_amount }}</td>
                    <td>{{ $calculation->tip_percentage }}%</td>
                    <td>{{ $calculation->total_with_tip }}</td>
                    <td>{{ $calculation->description }}</td>
                    <td>
                        <a href="{{ route('tips.edit', $calculation) }}">Editar</a>
                        <form action="{{ route('tips.destroy', $calculation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
