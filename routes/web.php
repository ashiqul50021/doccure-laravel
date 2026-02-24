<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Search & Booking
Route::get('/booking/{doctor_id}', [App\Http\Controllers\BookingController::class, 'index'])->name('booking');
Route::post('/booking/{doctor_id}', [App\Http\Controllers\BookingController::class, 'bookAppointment'])->name('booking.submit');
Route::get('/checkout', [App\Http\Controllers\BookingController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [App\Http\Controllers\BookingController::class, 'processPayment'])->name('booking.payment');
Route::view('/booking-success', 'frontend.booking-success')->name('booking.success');

// Doctor Backend Routes
require __DIR__ . '/doctor.php';

// Patient Routes
require __DIR__ . '/patient.php';

// Chat & Calls
Route::view('/chat', 'frontend.chat')->name('chat');
Route::view('/chat-doctor', 'frontend.chat-doctor')->name('chat.doctor');
Route::view('/voice-call', 'frontend.voice-call')->name('voice.call');
Route::view('/video-call', 'frontend.video-call')->name('video.call');



// Auth Pages
// Auth Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showPatientRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'registerPatient'])->name('register.submit');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', function () {
    return view('frontend.forgot-password');
})->name('forgot.password');

// Static Pages
Route::view('/components', 'frontend.components')->name('components');
Route::view('/blank-page', 'frontend.blank-page')->name('blank.page');
Route::view('/privacy-policy', 'frontend.privacy-policy')->name('privacy');
Route::view('/terms-condition', 'frontend.term-condition')->name('terms');


// Maintenance Routes
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'Migration run successfully!';
});

Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh --seed');
    return 'Migration Fresh with Seed run successfully!';
});

// API Routes for AJAX
Route::get('/api/areas/{district}', function (App\Models\District $district) {
    return response()->json($district->areas()->orderBy('name')->get());
})->name('api.areas');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/admin.php';

// Utility
Route::get('/link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully!';
});

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return 'Optimization and Cache Cleared!';
});

// Composer Routes
Route::get('/composer-install', function () {
    set_time_limit(0);
    $output = shell_exec('cd ' . base_path() . ' && composer install 2>&1');
    return '<pre>' . $output . '</pre>';
});

Route::get('/composer-update', function () {
    set_time_limit(0);
    $output = shell_exec('cd ' . base_path() . ' && composer update 2>&1');
    return '<pre>' . $output . '</pre>';
});
