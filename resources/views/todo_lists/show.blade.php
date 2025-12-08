@extends('layouts.app')

@section('content')
<h1>{{ $todoList->title }}</h1>
<p>{{ $todoList->description }}</p>

<p>
    <a href="{{ route('todo_lists.index') }}">Terug naar alle lijsten</a>
    |
    <a href="{{ route('todo_lists.edit', $todoList->id) }}">Lijst bewerken</a>
</p>

<h2>Taken in deze lijst</h2>

<!-- Knop voor nieuwe taak -->
<a href="{{ route('tasks.create', $todoList->id) }}">+ Nieuwe taak</a>
<br><br>

@if($todoList->tasks->count())
    <ul>
        @foreach($todoList->tasks as $task)
            <li>
                {{ $task->title }} - {{ $task->description }}
                <a href="{{ route('tasks.edit', [$todoList->id, $task->id]) }}">Bewerken</a>
            </li>
        @endforeach
    </ul>
@else
    <p>Geen taken in deze lijst</p>
@endif

@endsection
