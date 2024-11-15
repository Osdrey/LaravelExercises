<?php

namespace App\Http\Controllers\recipes;

use App\Http\Controllers\Controller;
use App\Models\Recipes\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // Mostrar todas las recetas con filtrado
    public function index(Request $request)
    {
        $query = Recipe::query();

        // Filtro por ingrediente si está presente
        if ($request->filled('ingredients')) {
            $query->where('ingredients', 'LIKE', '%' . $request->input('ingredients') . '%');
        }

        // Filtro por tipo de comida si está presente
        if ($request->filled('meal_type')) {
            $query->where('meal_type', $request->input('meal_type'));
        }

        // Filtro por tipo de dieta si está presente
        if ($request->filled('diet_type')) {
            $query->where('diet_type', $request->input('diet_type'));
        }

        // Filtro por nivel de dificultad si está presente
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->input('difficulty'));
        }

        // Filtro por tiempo de cocción si está presente
        if ($request->filled('cook_time')) {
            $query->where('cook_time', '<=', $request->input('cook_time'));
        }

        // Obtener los resultados filtrados
        $recipes = $query->get();

        return view('recipes.index', compact('recipes'));
    }

    // Mstrar el formulario de creación
    public function create()
    {
        return view('recipes.create'); // Asegúrate de que esta sea la ruta correcta de la vista
    }

    // Método para almacenar la nueva receta
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'title' => 'required',
            'ingredients' => 'required',
            'prep_time' => 'required|numeric',
            'cook_time' => 'required|numeric',
            'difficulty' => 'required',
            'meal_type' => 'required',
            'diet_type' => 'required',
            'category' => 'required',
        ]);

        // Crear nueva receta
        Recipe::create($request->all());

        return redirect()->route('recipes.index');
    }

    // Mostrar el formulario de edición de receta
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', compact('recipe'));
    }

    // Actualizar la receta
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'ingredients' => 'required',
            'prep_time' => 'required|integer',
            'cook_time' => 'required|integer',
            'difficulty' => 'required',
            'meal_type' => 'required',
            'diet_type' => 'required',
            'category' => 'required',
        ]);

        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->all());

        return redirect()->route('recipes.index');
    }

    // Eliminar una receta
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return redirect()->route('recipes.index');
    }
}
