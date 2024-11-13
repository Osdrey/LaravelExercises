@extends('layouts.app')

@section('content')
    <h1>Gastos de {{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</h1>

    <!-- Formulario para filtrar por categoría -->
    <form method="GET" action="{{ route('expenses.show', ['year' => $year, 'month' => $month]) }}">
        @csrf
        <div>
            <label for="category_id">Filtrar por categoría:</label>
            <select name="category_id" id="category_id" onchange="this.form.submit()">
                <option value="">Todos</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <ul>
        @foreach ($expenses as $expense)
            <li>
                {{ $expense->name }} - ${{ $expense->amount }}
                <a href="{{ route('expenses.edit', $expense->id) }}">Editar</a>
                <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('expenses.index') }}">Volver al Resumen de Gastos</a>
@endsection

