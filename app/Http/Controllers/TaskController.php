<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(TodoList $todoList)
    {
        return view('tasks.create', compact('todoList'));
    }

    public function store(Request $request, TodoList $todoList)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $task = Task::create($validated);
        $todoList->tasks()->attach($task->id);

        return redirect()->route('todo_lists.show', $todoList);
    }

    public function edit(TodoList $todoList, Task $task)
    {
        return view('tasks.edit', compact('todoList', 'task'));
    }

    public function update(Request $request, TodoList $todoList, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $task->update($validated);

        return redirect()->route('todo_lists.show', $todoList);
    }

    public function destroy(TodoList $todoList, Task $task)
    {
        $todoList->tasks()->detach($task->id);
        $task->delete();

        return redirect()->route('todo_lists.show', $todoList);
    }
}
