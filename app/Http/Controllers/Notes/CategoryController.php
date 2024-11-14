<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Notes\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categories = Category::all();
        return view('notes.categories.index', compact('categories'));
    }

    // Crear una nueva categoría
    public function create()
    {
        return view('notes.categories.create');
    }

    // Guardar la nueva categoría
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    // Eliminar una categoría
    public function destroy($id)
    {
        // Buscar la categoría por su ID
        $category = Category::findOrFail($id);

        // Eliminar la categoría
        $category->delete();

        // Redirigir de nuevo a la lista de categorías
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada con éxito');
    }
}
