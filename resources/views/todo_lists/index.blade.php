@extends('layouts.app')

@section('content')
<h1>Jouw lijsten</h1>
<a href="{{ route('todo_lists.create') }}">Nieuwe lijst</a>

<ul>
@foreach($lists as $list)
    <li>
        <a href="{{ route('todo_lists.show', $list) }}">{{ $list->title }}</a>
    </li>
@endforeach
</ul>
@endsection
