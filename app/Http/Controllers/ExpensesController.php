<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Categories;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    // Mostrar la lista de gastos por mes
    public function index()
    {
        // Obtener los gastos agrupados por mes y año
        $expensesByMonth = Expenses::selectRaw('YEAR(expense_date) as year, MONTH(expense_date) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Calcular el total anual de los gastos (suma de todos los gastos del año actual)
        $totalAnnual = Expenses::whereYear('expense_date', now()->year)->sum('amount');

        // Pasar los datos a la vista
        return view('expenses.index', compact('expensesByMonth', 'totalAnnual'));
    }

    // Crear una nueva categoría
    public function createCategory()
    {
        return view('expenses.createCategory');
    }

    // Almacenar una nueva categoría
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categories::create([
            'name' => $request->name,
        ]);

        return redirect()->route('expenses.create'); // Regresa a la vista de crear gasto
    }

    // Mostrar los detalles de los gastos de un mes
    public function show($year, $month, Request $request)
    {
        $categories = Categories::all(); // Traer todas las categorías
        $categoryId = $request->input('category_id'); // Obtener la categoría seleccionada

        // Filtrar los gastos según el año, mes y la categoría
        $expensesQuery = Expenses::whereYear('expense_date', $year)
            ->whereMonth('expense_date', $month);

        // Si se ha seleccionado una categoría, agregar el filtro
        if ($categoryId) {
            $expensesQuery->where('category_id', $categoryId);
        }

        $expenses = $expensesQuery->get();

        return view('expenses.show', compact('expenses', 'categories', 'year', 'month'));
    }

    // Crear un nuevo gasto
    public function create()
    {
        $categories = Categories::all(); // Traer todas las categorías
        return view('expenses.create', compact('categories'));
    }

    // Guardar el nuevo gasto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required',
            'expense_date' => 'required|date',
        ]);

        Expenses::create($request->all());

        return redirect()->route('expenses.index');
    }

    // Editar un gasto
    public function edit($id)
    {
        $expense = Expenses::findOrFail($id);
        $categories = Categories::all(); // Traer todas las categorías
        return view('expenses.edit', compact('expense', 'categories'));
    }

    // Actualizar un gasto
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required',
            'expense_date' => 'required|date',
        ]);

        $expense = Expenses::findOrFail($id);
        $expense->update($request->all());

        return redirect()->route('expenses.index');
    }

    // Eliminar un gasto
    public function destroy($id)
    {
        $expense = Expenses::findOrFail($id);
        $expense->delete();

        return redirect()->route('expenses.index');
    }
}
