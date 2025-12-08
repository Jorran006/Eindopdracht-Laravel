<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use App\Models\Task;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = auth()->user()->todoLists;
        return view('todo_lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo_lists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $data['user_id'] = auth()->id();

        TodoList::create($data);

        return redirect()->route('todo_lists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoList $todoList)
    {
        $todoList->load('tasks');
        $allTasks = Task::all();

        return view('todo_lists.show', compact('todoList', 'allTasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoList $todoList)
    {
        return view('todo_lists.edit', compact('todoList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TodoList $todoList)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $todoList->update($data);

        return redirect()->route('todo_lists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoList $todoList)
    {
        $todoList->delete();
        return redirect()->route('todo_lists.index');
    }


    /**
     * Attach task to this todo list.
     */
    public function attachTask(Request $request, TodoList $todoList)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
        ]);

        $todoList->tasks()->syncWithoutDetaching([$request->task_id]);

        return back();
    }

    /**
     * Detach task from this todo list.
     */
    public function detachTask(TodoList $todoList, Task $task)
    {
        $todoList->tasks()->detach($task->id);

        return back();
    }
}
