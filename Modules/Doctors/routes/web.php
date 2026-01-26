<?php

use Illuminate\Support\Facades\Route;
use Modules\Doctors\Http\Controllers\Frontend\DoctorController;
use Modules\Doctors\Http\Controllers\Frontend\BookingController;
use Modules\Doctors\Http\Controllers\Frontend\SearchController;
use Modules\Doctors\Http\Controllers\Backend\DoctorController as AdminDoctorController;
use Modules\Doctors\Http\Controllers\Backend\SpecialityController as AdminSpecialityController;

/*
|--------------------------------------------------------------------------
| Doctors Frontend Routes
|--------------------------------------------------------------------------
*/

Route::name('doctors.')->group(function () {
    // Search
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // Doctor Profile
    Route::get('/doctor-profile/{id}', [DoctorController::class, 'show'])->name('profile');

    // Booking
    Route::get('/booking/{doctor_id}', [BookingController::class, 'index'])->name('booking');
    Route::post('/booking/{doctor_id}', [BookingController::class, 'bookAppointment'])->name('booking.submit');
    Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [BookingController::class, 'processPayment'])->name('booking.payment');
    Route::view('/booking-success', 'doctors::frontend.booking-success')->name('booking.success');

    // Doctor Dashboard (static views for now)
    Route::view('/doctor-dashboard', 'doctors::frontend.doctor-dashboard')->name('dashboard');
    Route::view('/doctor-register', 'doctors::frontend.doctor-register')->name('register');
});

/*
|--------------------------------------------------------------------------
| Doctors Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('doctors.admin.')->group(function () {
    Route::resource('doctors', AdminDoctorController::class);
    Route::resource('specialities', AdminSpecialityController::class);
});
