@extends('layouts.app')

@section('content')
    <h1>Editar Gasto</h1>

    <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $expense->name) }}" required>
        </div>

        <div>
            <label for="amount">Monto:</label>
            <input type="number" name="amount" id="amount" value="{{ old('amount', $expense->amount) }}" required>
        </div>

        <div>
            <label for="category_id">Categoría:</label>
            <select name="category_id" id="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="expense_date">Fecha:</label>
            <input type="date" name="expense_date" id="expense_date" value="{{ old('expense_date', $expense->expense_date ? date('Y-m-d', strtotime($expense->expense_date)) : '') }}" required>
        </div>

        <div>
            <label for="description">Descripción:</label>
            <textarea name="description" id="description">{{ old('description', $expense->description) }}</textarea>
        </div>

        <button type="submit">Guardar cambios</button>
    </form>
@endsection
