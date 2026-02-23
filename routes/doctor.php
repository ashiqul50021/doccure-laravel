<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Doctor Routes
|--------------------------------------------------------------------------
*/

// Doctor Dashboard & Settings
Route::get('/doctor-dashboard', [\App\Http\Controllers\Doctor\DashboardController::class, 'index'])->name('doctor.dashboard');
Route::post('/appointment/accept/{id}', [\App\Http\Controllers\Doctor\DashboardController::class, 'acceptAppointment'])->name('appointment.accept');
Route::post('/appointment/cancel/{id}', [\App\Http\Controllers\Doctor\DashboardController::class, 'cancelAppointment'])->name('appointment.cancel');

// Profile Settings
Route::get('/doctor-profile-settings', [\App\Http\Controllers\Doctor\DashboardController::class, 'profileSettings'])->name('doctor.profile.settings');

// Change Password
Route::get('/doctor-change-password', [\App\Http\Controllers\Doctor\DashboardController::class, 'changePassword'])->name('doctor.change.password');
Route::post('/doctor-change-password', [\App\Http\Controllers\Doctor\DashboardController::class, 'updatePassword'])->name('doctor.change.password.update');

// Appointments
Route::get('/appointments', [\App\Http\Controllers\Doctor\DashboardController::class, 'appointments'])->name('appointments');

// My Patients
Route::get('/my-patients', [\App\Http\Controllers\Doctor\DashboardController::class, 'myPatients'])->name('my.patients');

// Reviews
Route::get('/reviews', [\App\Http\Controllers\Doctor\DashboardController::class, 'reviews'])->name('reviews');

// Invoices
Route::get('/invoices', [\App\Http\Controllers\Doctor\DashboardController::class, 'invoices'])->name('invoices');

// Social Media
Route::get('/social-media', [\App\Http\Controllers\Doctor\DashboardController::class, 'socialMedia'])->name('social.media');
Route::post('/social-media', [\App\Http\Controllers\Doctor\DashboardController::class, 'updateSocialMedia'])->name('social.media.update');

// Schedule Timings
Route::get('/schedule-timings', [App\Http\Controllers\Doctor\ScheduleController::class, 'index'])->name('schedule.timings');
Route::post('/schedule-timings', [App\Http\Controllers\Doctor\ScheduleController::class, 'store'])->name('schedule.store');
Route::delete('/schedule-timings/{id}', [App\Http\Controllers\Doctor\ScheduleController::class, 'destroy'])->name('schedule.destroy');

// Calendar
Route::view('/calendar', 'frontend.calendar')->name('calendar');

// Invoices & Billing Views
Route::view('/invoice-view', 'frontend.invoice-view')->name('invoice.view');
Route::view('/add-billing', 'frontend.add-billing')->name('add.billing');
Route::view('/edit-billing', 'frontend.edit-billing')->name('edit.billing');

// Prescriptions
Route::view('/add-prescription', 'frontend.add-prescription')->name('add.prescription');
Route::view('/edit-prescription', 'frontend.edit-prescription')->name('edit.prescription');
