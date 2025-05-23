@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h3 class="mb-4">📂 Manage Events</h3>

    <a href="{{ route('events.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Create Event
    </a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Date/Time</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->date }} {{ $event->time }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->capacity }}</td>
                <td>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection