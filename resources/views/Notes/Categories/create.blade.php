@extends('layouts.app')

@section('content')
    <h1>Crear Nueva Categoría</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre de la Categoría</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Categoría</button>
    </form>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Volver a la lista de categorías</a>
@endsection
