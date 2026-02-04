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

// Doctor Pages
Route::get('/doctor-profile/{id}', [App\Http\Controllers\DoctorController::class, 'show'])->name('doctor.profile');
Route::view('/doctor-dashboard', 'frontend.doctor-dashboard')->name('doctor.dashboard');
Route::get('/doctor-register', [App\Http\Controllers\AuthController::class, 'showDoctorRegisterForm'])->name('doctor.register');
Route::post('/doctor-register', [App\Http\Controllers\AuthController::class, 'registerDoctor'])->name('doctor.register.submit');
Route::view('/doctor-profile-settings', 'frontend.doctor-profile-settings')->name('doctor.profile.settings');
Route::view('/doctor-change-password', 'frontend.doctor-change-password')->name('doctor.change.password');

// Patient Pages
Route::view('/patient-dashboard', 'frontend.patient-dashboard')->name('patient.dashboard');
Route::view('/patient-profile', 'frontend.patient-profile')->name('patient.profile');
Route::view('/profile-settings', 'frontend.profile-settings')->name('profile.settings');
Route::view('/change-password', 'frontend.change-password')->name('change.password');
Route::view('/favourites', 'frontend.favourites')->name('favourites');
Route::view('/my-patients', 'frontend.my-patients')->name('my.patients');

// Appointments & Schedule
Route::view('/appointments', 'frontend.appointments')->name('appointments');
Route::view('/schedule-timings', 'frontend.schedule-timings')->name('schedule.timings');
Route::view('/calendar', 'frontend.calendar')->name('calendar');

// Invoices & Billing
Route::view('/invoices', 'frontend.invoices')->name('invoices');
Route::view('/invoice-view', 'frontend.invoice-view')->name('invoice.view');
Route::view('/add-billing', 'frontend.add-billing')->name('add.billing');
Route::view('/edit-billing', 'frontend.edit-billing')->name('edit.billing');

// Prescriptions
Route::view('/add-prescription', 'frontend.add-prescription')->name('add.prescription');
Route::view('/edit-prescription', 'frontend.edit-prescription')->name('edit.prescription');

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

// Admin Auth Routes (Guest)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    // Core Modules
    Route::get('/doctors', [App\Http\Controllers\AdminController::class, 'doctors'])->name('doctors.index');
    Route::post('/doctors/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveDoctor'])->name('doctors.approve');
    Route::post('/doctors/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectDoctor'])->name('doctors.reject');

    // Resource Routes
    Route::resource('doctors', App\Http\Controllers\Admin\DoctorController::class)->except(['index']);
    // Uses AdminController@doctors for index, resource for others if needed

    // Order Management
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status');

    // Coupon Management
    Route::resource('coupons', App\Http\Controllers\Admin\CouponController::class);

    Route::get('/patients', [App\Http\Controllers\AdminController::class, 'patients'])->name('patients');
    Route::get('/appointments', [App\Http\Controllers\AdminController::class, 'appointments'])->name('appointments');
    Route::get('/reviews', [App\Http\Controllers\AdminController::class, 'reviews'])->name('reviews');
    Route::get('/transactions', [App\Http\Controllers\AdminController::class, 'transactions'])->name('transactions');
    Route::get('/invoice-report', [App\Http\Controllers\AdminController::class, 'reports'])->name('invoice.report');

    Route::resource('specialities', App\Http\Controllers\Admin\SpecialityController::class);
    Route::resource('product-categories', App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('advertisements', App\Http\Controllers\Admin\AdvertisementController::class);

    // Site Settings
    Route::get('/site-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::put('/site-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('site-settings.update');
    Route::put('/site-settings/banner', [App\Http\Controllers\Admin\SiteSettingController::class, 'updateBanner'])->name('site-settings.update-banner');

    // Banners
    Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);

    // Banner Settings
    Route::get('/banner-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'bannerIndex'])->name('banner-settings.index');
    Route::put('/banner-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'updateBanner'])->name('banner-settings.update');

    // Menu Manager
    Route::get('menus/{menu}/delete', [App\Http\Controllers\Admin\MenuController::class, 'delete'])->name('menus.delete');
    Route::resource('menus', App\Http\Controllers\Admin\MenuController::class);

    // Profile
    Route::view('/profile', 'admin.profile')->name('profile');
});

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
