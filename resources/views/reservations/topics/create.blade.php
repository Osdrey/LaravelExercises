@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Tema</h1>
        <form method="POST" action="{{ route('reservations.topics.store') }}">
            @csrf
            <div class="form-group">
                <label for="class_id">Seleccionar Clase</label>
                <select name="class_id" class="form-control" id="class_id" required>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->subject }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Nombre del Tema</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar Tema</button>
        </form>
    </div>
@endsection
