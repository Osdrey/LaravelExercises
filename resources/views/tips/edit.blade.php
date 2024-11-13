@extends('layouts.app')

@section('content')
    <h1>Editar Cálculo de Propina</h1>
    <form action="{{ route('tips.update', $tipCalculator) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="bill_amount">Monto de la Cuenta:</label>
            <input type="number" step="0.01" name="bill_amount" id="bill_amount" value="{{ $tipCalculator->bill_amount }}" required>
        </div>
        <div>
            <label for="tip_percentage">Porcentaje de Propina:</label>
            <input type="number" step="0.01" name="tip_percentage" id="tip_percentage" value="{{ $tipCalculator->tip_percentage }}" required>
        </div>
        <div>
            <label for="description">Descripción:</label>
            <input type="text" name="description" id="description" value="{{ $tipCalculator->description }}">
        </div>
        <button type="submit">Actualizar Cálculo</button>
    </form>
@endsection
