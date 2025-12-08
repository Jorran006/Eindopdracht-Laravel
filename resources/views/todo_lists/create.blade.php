@extends('layouts.app')

@section('content')
<h1>Nieuwe lijst maken</h1>

<form action="{{ route('todo_lists.store') }}" method="POST">
    @csrf
    <label>Titel:</label>
    <input type="text" name="title">
    <label>Beschrijving:</label>
    <textarea name="description"></textarea>
    <button type="submit">Opslaan</button>
</form>

<a href="{{ route('todo_lists.index') }}">Terug</a>
@endsection
