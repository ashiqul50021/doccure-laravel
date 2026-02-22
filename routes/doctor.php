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
Route::view('/doctor-profile-settings', 'frontend.doctor-profile-settings')->name('doctor.profile.settings');
Route::view('/doctor-change-password', 'frontend.doctor-change-password')->name('doctor.change.password');

// Appointments & Schedule
Route::view('/appointments', 'frontend.appointments')->name('appointments');
Route::get('/schedule-timings', [App\Http\Controllers\Doctor\ScheduleController::class, 'index'])->name('schedule.timings');
Route::post('/schedule-timings', [App\Http\Controllers\Doctor\ScheduleController::class, 'store'])->name('schedule.store');
Route::delete('/schedule-timings/{id}', [App\Http\Controllers\Doctor\ScheduleController::class, 'destroy'])->name('schedule.destroy');
Route::view('/calendar', 'frontend.calendar')->name('calendar');

// Invoices & Billing
Route::view('/invoices', 'frontend.invoices')->name('invoices');
Route::view('/invoice-view', 'frontend.invoice-view')->name('invoice.view');
Route::view('/add-billing', 'frontend.add-billing')->name('add.billing');
Route::view('/edit-billing', 'frontend.edit-billing')->name('edit.billing');

// Prescriptions
Route::view('/add-prescription', 'frontend.add-prescription')->name('add.prescription');
Route::view('/edit-prescription', 'frontend.edit-prescription')->name('edit.prescription');
