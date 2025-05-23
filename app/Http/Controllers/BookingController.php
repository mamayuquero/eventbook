<?php

// app/Http/Controllers/BookingController.php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class BookingController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $bookings = Booking::with('user', 'event')->get();
        } else {
            $bookings = Booking::with('event')
                ->where('user_id', Auth::id())
                ->get();
        }

        return view('bookings.index', compact('bookings'));
    }




    public function create()
    {
        $events = Event::all();
        return view('bookings.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Confirm credentials match
        if (
            $user->email !== $request->email ||
            !Hash::check($request->password, $user->password)
        ) {
            return back()->withErrors(['credentials' => 'Your information does not match our records.'])->withInput();
        }

        // Create the booking
        Booking::create([
            'user_id' => $user->id,
            'event_id' => $request->event_id,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Event booked successfully.');
    }

    public function destroy(Booking $booking)
    {
        if (Auth::id() === $booking->user_id || Auth::user()->role === 'admin') {
            $booking->delete();
        }
        return redirect()->route('bookings.index');
    }
}
