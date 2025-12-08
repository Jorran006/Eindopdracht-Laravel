@extends('layouts.app')

@section('content')
<h1>Nieuwe taak toevoegen aan: {{ $todoList->title }}</h1>

<form method="POST" action="{{ route('tasks.store', $todoList->id) }}">
    @csrf

    <label>Naam:</label><br>
    <input type="text" name="title"><br><br>

    <label>Omschrijving:</label><br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Opslaan</button>
</form>

<p><a href="{{ route('todo_lists.show', $todoList) }}">Terug naar lijst</a></p>
@endsection
