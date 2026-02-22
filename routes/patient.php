<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Patient Routes
|--------------------------------------------------------------------------
*/

// Patient Pages
Route::view('/patient-dashboard', 'frontend.patient-dashboard')->name('patient.dashboard');
Route::view('/patient-profile', 'frontend.patient-profile')->name('patient.profile');
Route::view('/profile-settings', 'frontend.profile-settings')->name('profile.settings');
Route::view('/change-password', 'frontend.change-password')->name('change.password');
Route::view('/favourites', 'frontend.favourites')->name('favourites');
Route::view('/my-patients', 'frontend.my-patients')->name('my.patients');
