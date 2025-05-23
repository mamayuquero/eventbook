@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h3 class="mb-4">
        {{ Auth::user()->role === 'admin' ? '🛠️ Manage Bookings' : '📋 Bookings' }}
    </h3>

    @if($bookings->isEmpty())
    <p class="text-muted">
        {{ Auth::user()->role === 'admin' ? 'No bookings made yet.' : 'You have no bookings yet.' }}
    </p>
    @else
    <div class="table-responsive">
        <table class="table align-middle table-bordered">
            <thead class="table-light">
                <tr>
                    <th>🎫 Event</th>
                    @if (Auth::user()->role === 'admin')
                    <th>👤 User</th>
                    <th>📧 Email</th>
                    @endif
                    <th>⚙️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->event->title }}</td>
                    @if (Auth::user()->role === 'admin')
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->user->email }}</td>
                    @endif
                    <td>
                        <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-x-circle"></i>
                                {{ Auth::user()->role === 'admin' ? 'Remove' : 'Cancel' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if(Auth::user()->role !== 'admin')
    <a href="{{ route('bookings.create') }}" class="btn btn-success mt-3">
        <i class="bi bi-plus-circle"></i> Book New Event
    </a>
    @endif
</div>
@endsection