@extends('layouts.app')

@section('content')
<div class="card p-4 text-center">
    <h3 class="mb-3">Welcome back, {{ Auth::user()->name }} 👋</h3>
    <p class="text-muted">Use the navigation above to manage bookings and events.</p>
</div>
@endsection