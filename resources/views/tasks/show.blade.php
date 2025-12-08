@extends('layouts.app')

@section('content')
<h1>{{ $task->name }}</h1>

<p>{{ $task->description }}</p>

<a href="{{ route('tasks.edit', $task) }}">Bewerken</a>
@endsection
