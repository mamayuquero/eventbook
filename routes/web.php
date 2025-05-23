<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\Auth\LogoutController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('bookings', BookingController::class);
});

Route::middleware(['auth', CheckAdmin::class])->group(function () {
    Route::resource('events', EventController::class);
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('home'); // guest view
})->name('welcome');

Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/logout-success', function () {
    return view('logout');
})->name('logout.success');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
