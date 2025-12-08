@extends('layouts.app')

@section('content')

<h1>{{ $todoList->title }}</h1>
<p>{{ $todoList->description }}</p>

<p>
    <a href="{{ route('todo_lists.index') }}">Terug naar alle lijsten</a>
    |
    <a href="{{ route('todo_lists.edit', $todoList->id) }}">Lijst bewerken</a>
    |
    <form action="{{ route('todo_lists.destroy', $todoList->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je deze lijst wilt verwijderen?');">
        @csrf
        @method('DELETE')
        <button type="submit">Verwijderen</button>
    </form>
</p>

<h2>Taken in deze lijst</h2>

<p><a href="{{ route('tasks.create', $todoList->id) }}">+ Nieuwe taak</a></p>

@if($todoList->tasks->count())
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Taak</th>
                <th>Omschrijving</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todoList->tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', [$todoList->id, $task->id]) }}">Bewerken</a>

                        <form action="{{ route('tasks.destroy', [$todoList->id, $task->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Geen taken in deze lijst</p>
@endif

@endsection
