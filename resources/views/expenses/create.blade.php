@extends('layouts.app')

@section('content')
    <h1>Crear Gasto</h1>

    <form method="POST" action="{{ route('expenses.store') }}">
        @csrf
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="amount">Monto:</label>
            <input type="number" name="amount" id="amount" required>
        </div>

        <div>
            <label for="category_id">Categoría:</label>
            <select name="category_id" id="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="expense_date">Fecha:</label>
            <input type="date" name="expense_date" id="expense_date" required>
        </div>

        <div>
            <label for="description">Descripción:</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <button type="submit">Guardar</button>

        <a href="{{ route('expenses.index') }}">Volver al Resumen de Gastos</a>
    </form>
@endsection
