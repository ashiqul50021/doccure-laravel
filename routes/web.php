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
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('/booking/{doctor_id}', [App\Http\Controllers\BookingController::class, 'index'])->name('booking');
Route::post('/booking/{doctor_id}', [App\Http\Controllers\BookingController::class, 'bookAppointment'])->name('booking.submit');
Route::get('/checkout', [App\Http\Controllers\BookingController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [App\Http\Controllers\BookingController::class, 'processPayment'])->name('booking.payment');
Route::view('/booking-success', 'frontend.booking-success')->name('booking.success');

// Products & Cart
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::post('/cart/add', [App\Http\Controllers\ProductController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [App\Http\Controllers\ProductController::class, 'cart'])->name('cart');
Route::post('/cart/remove', [App\Http\Controllers\ProductController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [App\Http\Controllers\ProductController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/apply-coupon', [App\Http\Controllers\ProductController::class, 'applyCoupon'])->name('cart.coupon');
Route::get('/product-checkout', [App\Http\Controllers\ProductController::class, 'checkout'])->name('product.checkout');
Route::post('/place-order', [App\Http\Controllers\ProductController::class, 'placeOrder'])->name('order.place');
Route::get('/order-success/{id}', [App\Http\Controllers\ProductController::class, 'orderSuccess'])->name('order.success');
Route::get('/orders/{id}/invoice', [App\Http\Controllers\ProductController::class, 'invoice'])->name('order.invoice');

// Public Doctor Pages
Route::get('/doctor-profile/{id}', [App\Http\Controllers\DoctorController::class, 'show'])->name('doctor.profile');
Route::get('/doctor-register', [App\Http\Controllers\AuthController::class, 'showDoctorRegisterForm'])->name('doctor.register');
Route::post('/doctor-register', [App\Http\Controllers\AuthController::class, 'registerDoctor'])->name('doctor.register.submit');

// Doctor Backend Routes
require __DIR__ . '/doctor.php';

// Patient Routes
require __DIR__ . '/patient.php';

// Chat & Calls
Route::view('/chat', 'frontend.chat')->name('chat');
Route::view('/chat-doctor', 'frontend.chat-doctor')->name('chat.doctor');
Route::view('/voice-call', 'frontend.voice-call')->name('voice.call');
Route::view('/video-call', 'frontend.video-call')->name('video.call');

// Reviews
Route::view('/reviews', 'frontend.reviews')->name('reviews');

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
Route::view('/social-media', 'frontend.social-media')->name('social.media');

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

Route::get('/api/products/filter', [App\Http\Controllers\ProductController::class, 'filter'])->name('api.products.filter');

Route::get('/api/doctors/filter', function (Illuminate\Http\Request $request) {
    $query = App\Models\Doctor::with(['user', 'speciality', 'area', 'reviews'])
        ->where('status', 'approved')
        ->whereHas('user');

    if ($request->speciality && $request->speciality !== 'all') {
        $query->where('speciality_id', $request->speciality);
    }

    if ($request->search) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }

    $doctors = $query->take(9)->get()->map(function ($doctor) {
        return [
            'id' => $doctor->id,
            'name' => $doctor->user->name ?? 'Unknown',
            'speciality' => $doctor->speciality->name ?? 'General',
            'profile_image' => $doctor->profile_image,
            'pricing' => $doctor->pricing,
            'custom_price' => $doctor->custom_price,
            'average_rating' => $doctor->average_rating,
            'review_count' => $doctor->review_count,
            'clinic_name' => $doctor->clinic_name,
            'area_name' => $doctor->area->name ?? 'Dhaka',
        ];
    });

    return response()->json($doctors);
})->name('api.doctors.filter');

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
