<?php

namespace App\Http\Controllers\reservations;

use App\Models\Topics;
use App\Models\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    // Mostrar listado de temas
    public function index()
    {
        $topics = Topics::with('class')->get();
        return view('reservations.topics.index', compact('topics'));
    }

    // Mostrar el formulario para crear un nuevo tema
    public function create()
    {
        $classes = Classes::all();
        return view('reservations.topics.create', compact('classes'));
    }

    // Guardar un nuevo tema
    public function store(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'class_id' => [
                'required',
                'exists:classes,id'  // Verifica que el class_id exista en la tabla de clases
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                // Verifica que el nombre del tema sea único por clase
                'unique:topics,name,NULL,id,class_id,' . $request->class_id
            ]
        ]);

        // Crear el tema
        $topic = Topics::create([
            'class_id' => $request->class_id,
            'name' => $request->name,
        ]);

        // Redirigir o devolver una respuesta
        return redirect()->route('reservations.topics.index')->with('success', 'Tema creado correctamente');
    }

    // Mostrar los detalles de un tema
    public function show($id)
    {
        $topic = Topics::with('class')->findOrFail($id);
        return view('reservations.topics.show', compact('topic'));
    }

    // Mostrar el formulario para editar un tema
    public function edit($id)
    {
        $topic = Topics::findOrFail($id);
        $classes = Classes::all();
        return view('reservations.topics.edit', compact('topic', 'classes'));
    }

    // Actualizar un tema
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $topic = Topics::findOrFail($id);
        $topic->update([
            'class_id' => $request->class_id,
            'name' => $request->name,
        ]);

        return redirect()->route('reservations.topics.index');
    }

    // Eliminar un tema
    public function destroy($id)
    {
        $topic = Topics::findOrFail($id);
        $topic->delete();
        return redirect()->route('reservations.topics.index');
    }
}
