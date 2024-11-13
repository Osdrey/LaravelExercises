@extends('layouts.app')

@section('content')
    <h1>Resumen de Gastos</h1>

    <h2>Total Gastado en el Año: ${{ number_format($totalAnnual, 2) }}</h2>

    <div class="buttons">
        <!-- Botón para crear gasto -->
        <a href="{{ route('expenses.create') }}" class="btn">Crear Nuevo Gasto</a>
        <!-- Botón para crear categoría -->
        <a href="{{ route('categories.create') }}" class="btn">Crear Nueva Categoría</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Año</th>
                <th>Mes</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expensesByMonth as $expense)
                <tr>
                    <td>{{ $expense->year }}</td>
                    <td>{{ $expense->month }}</td>
                    <td>{{ number_format($expense->total, 2) }}</td>
                    <td>
                        <a href="{{ route('expenses.show', ['year' => $expense->year, 'month' => $expense->month]) }}">Ver gastos</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
