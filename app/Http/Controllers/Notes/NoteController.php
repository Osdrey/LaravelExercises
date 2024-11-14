<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Notes\Note;
use App\Models\Notes\Category;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // Mostrar todas las notas
    public function index(Request $request)
    {
        // Obtener todas las categorías para el filtro
        $categories = Category::all();

        // Filtrar notas por categoría si se pasa un parámetro de categoría
        if ($request->has('category_id') && $request->category_id != '') {
            $notes = Note::where('category_id', $request->category_id)->get();
        } else {
            // Si no se filtra, mostrar todas las notas
            $notes = Note::all();
        }

        return view('notes.index', compact('notes', 'categories'));
    }

    // Crear una nueva nota
    public function create()
    {
        $categories = Category::all();
        return view('notes.create', compact('categories'));
    }

    // Guardar la nueva nota
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        Note::create($request->all());
        return redirect()->route('notes.index');
    }

    // Editar una nota
    public function edit($id)
    {
        $note = Note::findOrFail($id);
        $categories = Category::all();
        return view('notes.edit', compact('note', 'categories'));
    }

    // Actualizar una nota
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $note = Note::findOrFail($id);
        $note->update($request->all());
        return redirect()->route('notes.index');
    }

    // Eliminar una nota
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return redirect()->route('notes.index');
    }
}
