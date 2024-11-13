@extends('layouts.app')

@section('content')
    <h1>Generador de Contraseñas Seguras</h1>

    <form method="POST" action="{{ route('password.generate') }}">
        @csrf
        <div>
            <label for="length">Longitud de la Contraseña:</label>
            <input type="number" name="length" id="length" value="12" min="6" max="32">
        </div>
        <div>
            <label for="include_uppercase">Incluir mayúsculas</label>
            <input type="checkbox" name="include_uppercase" id="include_uppercase">
        </div>
        <div>
            <label for="include_numbers">Incluir números</label>
            <input type="checkbox" name="include_numbers" id="include_numbers">
        </div>
        <div>
            <label for="include_special">Incluir caracteres especiales</label>
            <input type="checkbox" name="include_special" id="include_special">
        </div>
        <button type="submit">Generar Contraseña</button>
    </form>

    @if (isset($password))
        <div>
            <h3>Contraseña Generada:</h3>
            <p>{{ $password }}</p>
        </div>
    @endif
@endsection
