<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use App\Models\Task;

class ListTaskController extends Controller
{
    public function attach(Request $request, TodoList $todoList)
    {
        $taskId = $request->input('task_id');
        $todoList->tasks()->syncWithoutDetaching([$taskId]);
        return back()->with('success', 'Taak toegevoegd aan lijst');
    }

    public function detach(TodoList $todoList, Task $task)
    {
        $todoList->tasks()->detach($task->id);
        return back()->with('success', 'Taak verwijderd uit lijst');
    }
}
