<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\AdminController as AdminMainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Room Routes (Public)
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

// Authentication Required Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Booking Routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/rooms/{room}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Payment routes
    Route::post('/bookings/{booking}/payments/process', [PaymentController::class, 'process'])->name('payments.process');
    Route::post('/bookings/{booking}/upload-proof', [PaymentController::class, 'uploadProof'])->name('payments.upload_proof');
});

require __DIR__.'/auth.php';

// Admin routes (admin panel)
Route::prefix('admin')->name('admin.')->middleware(['auth','can:access-admin'])->group(function () {
    Route::get('/', [AdminMainController::class, 'dashboard'])->name('dashboard');

    // Rooms (resource)
    Route::resource('rooms', AdminRoomController::class)->names('rooms');

    // Bookings (index, show, update) + export
    Route::get('bookings/export', [AdminBookingController::class, 'export'])->name('bookings.export');
    Route::resource('bookings', AdminBookingController::class)->only(['index','show','update'])->names('bookings');
});
