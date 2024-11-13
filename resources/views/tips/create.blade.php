@extends('layouts.app')

@section('content')
    <h1>Nuevo Cálculo de Propina</h1>
    <form action="{{ route('tips.store') }}" method="POST">
        @csrf
        <div>
            <label for="bill_amount">Monto de la Cuenta:</label>
            <input type="number" step="0.01" name="bill_amount" id="bill_amount" required>
        </div>
        <div>
            <label for="tip_percentage">Porcentaje de Propina:</label>
            <input type="number" step="0.01" name="tip_percentage" id="tip_percentage" required>
        </div>
        <div>
            <label for="description">Descripción:</label>
            <input type="text" name="description" id="description">
        </div>
        <button type="submit">Calcular y Guardar</button>
    </form>
@endsection
