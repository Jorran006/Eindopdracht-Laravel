@extends('layouts.app')

@section('content')
<h1>Alle taken</h1>

<ul>
@foreach($tasks as $task)
    <li>
        {{ $task->name }}
        (behoort bij lijst: {{ $task->todoList->title }})

        <a href="{{ route('tasks.edit', $task) }}">Bewerken</a>

        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Verwijderen</button>
        </form>
    </li>
@endforeach
</ul>
@endsection
