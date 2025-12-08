@extends('layouts.app')

@section('content')
<h1>Jouw lijsten</h1>
<p><a href="{{ route('todo_lists.create') }}">Nieuwe lijst</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Lijst</th>
            <th>Beschrijving</th>
            <th>Aantal taken</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
    @forelse($lists as $list)
        <tr>
            <td><a href="{{ route('todo_lists.show', $list) }}">{{ $list->title }}</a></td>
            <td>{{ $list->description }}</td>
            <td>{{ $list->tasks->count() }}</td>
            <td>
                <a href="{{ route('todo_lists.edit', $list->id) }}">Bewerken</a>

                <form action="{{ route('todo_lists.destroy', $list->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je deze lijst wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Verwijderen</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Je hebt nog geen lijsten.</td>
        </tr>
    @endforelse
    </tbody>
</table>

@endsection
