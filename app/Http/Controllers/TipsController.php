<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function index()
    {
        // Mostrar todos los cálculos realizados desde la tabla 'tips'
        $calculations = Tips::all();
        return view('tips.index', compact('calculations'));
    }

    public function create()
    {
        // Mostrar formulario de creación
        return view('tips.create');
    }

    public function store(Request $request)
    {
        // Validar datos recibidos
        $request->validate([
            'bill_amount' => 'required|numeric|min:0',
            'tip_percentage' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        // Realizar el cálculo de la propina
        $tipAmount = ($request->bill_amount * $request->tip_percentage) / 100;

        // Calcular el total (monto de la cuenta + propina)
        $total = $request->bill_amount + $tipAmount;

        // Crear el registro y guardar los valores en la base de datos
        Tips::create([
            'bill_amount' => $request->bill_amount,
            'tip_percentage' => $request->tip_percentage,
            'total_with_tip' => $total,  // Guardar el total con la propina en la base de datos
            'description' => $request->description,
        ]);

        // Redirigir a la lista de cálculos
        return redirect()->route('tips.index');
    }

    public function edit(Tips $tips)
    {
        // Mostrar formulario de edición
        return view('tips.edit', compact('tips'));
    }

    public function update(Request $request, Tips $tips)
    {
        // Validar los datos para la actualización
        $request->validate([
            'bill_amount' => 'required|numeric|min:0',
            'tip_percentage' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        // Recalcular el total con la propina
        $totalWithTip = $request->bill_amount + ($request->bill_amount * ($request->tip_percentage / 100));

        // Actualizar el cálculo
        $tips->update([
            'bill_amount' => $request->bill_amount,
            'tip_percentage' => $request->tip_percentage,
            'total_with_tip' => $totalWithTip,
            'description' => $request->description,
        ]);

        // Redirigir de nuevo a la lista de cálculos con mensaje de éxito
        return redirect()->route('tips.index')->with('success', 'Cálculo actualizado.');
    }

    public function destroy(Tips $tips)
    {
        // Eliminar el cálculo
        $tips->delete();

        // Redirigir a la lista de cálculos con mensaje de éxito
        return redirect()->route('tips.index')->with('success', 'Cálculo eliminado.');
    }
}
