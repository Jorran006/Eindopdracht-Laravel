@extends('layouts.app')

@section('content')
<h1>Taak bewerken: {{ $task->title }}</h1>

<form action="{{ route('tasks.update', [$todoList->id, $task->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Naam taak:</label>
    <input type="text" name="title" value="{{ $task->title }}">

    <label>Beschrijving:</label>
    <textarea name="description">{{ $task->description }}</textarea>

    <button type="submit">Wijzigen</button>
</form>

<form action="{{ route('tasks.destroy', [$todoList->id, $task->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Verwijderen</button>
</form>

@endsection
