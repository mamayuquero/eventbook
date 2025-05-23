@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h3 class="mb-4">🔒 Confirm Identity to Book Event</h3>

    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf

        <div class="mb-3">
            <label for="event_id" class="form-label">Select Event</label>
            <select name="event_id" class="form-select" required>
                @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->title }} — {{ $event->date }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Your Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Your Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Address (optional)</label>
            <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Your Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirm & Book</button>
    </form>

    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection