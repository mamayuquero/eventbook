@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h3 class="mb-4">🆕 Create New Event</h3>

    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">📅 Event Date</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-calendar-date"></i></span>
                    <input type="text" id="date" name="date" class="form-control" value="{{ old('date') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">⏰ Event Time</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-clock"></i></span>
                    <input type="text" id="time" name="time" class="form-control" value="{{ old('time') }}" required>
                </div>
            </div>
        </div>


        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control" required>
        </div>

        <button class="btn btn-primary">Create Event</button>
    </form>
</div>
@endsection