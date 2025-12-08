@extends('layouts.app')

@section('content')
<h1>Lijst bewerken: {{ $todoList->title }}</h1>

<form action="{{ route('todo_lists.update', $todoList->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Titel:</label>
    <input type="text" name="title" value="{{ $todoList->title }}">

    <label>Beschrijving:</label>
    <textarea name="description">{{ $todoList->description }}</textarea>

    <button type="submit">Wijzigen</button>
</form>

<form action="{{ route('todo_lists.destroy', $todoList->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze lijst wilt verwijderen?');">
    @csrf
    @method('DELETE')
    <button type="submit">Verwijderen</button>
</form>

<p><a href="{{ route('todo_lists.index') }}">Terug</a></p>
@endsection
