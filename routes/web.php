<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ListTaskController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return redirect()->route('todo_lists.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profiel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Todo lists CRUD
    Route::resource('todo_lists', TodoListController::class);

    // Nested task routes under a todo_list
    Route::get('todo_lists/{todo_list}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('todo_lists/{todo_list}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('todo_lists/{todo_list}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('todo_lists/{todo_list}/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('todo_lists/{todo_list}/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Attach/detach existing tasks to/from a todo list (separate paths to avoid collisions)
    Route::post('todo_lists/{todo_list}/tasks/attach', [ListTaskController::class,'attach'])
        ->name('todo_lists.tasks.attach');

    Route::delete('todo_lists/{todo_list}/tasks/{task}/detach', [ListTaskController::class,'detach'])
        ->name('todo_lists.tasks.detach');

});

require __DIR__.'/auth.php';
