<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
        ]);

        Task::create([
            'task_name' => $request->task_name,
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'task_name' => $request->task_name,
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function toggleComplete($id)
    {
        $task = Task::findOrFail($id);
        $task->is_completed = !$task->is_completed; // Cambiar el estado
        $task->save();

        return redirect()->route('tasks.index');
    }
}
