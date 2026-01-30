@extends('layouts.app')

@section('title', 'Doccure - Doctor Appointment Booking')

@section('content')
<!-- Home Banner - DocTime Inspired -->
<section class="section-hero-doctime">
    <!-- Background Wave Pattern -->
    <div class="hero-wave-pattern"></div>

    <div class="container">
        <!-- Hero Slider -->
        <div class="hero-slider">
            @if(isset($banners) && $banners->count() > 0)
                @foreach($banners as $banner)
                    @if($banner->type == 'content_image')
                    <!-- Content + Image Slide -->
                    <div class="hero-slide-item">
                        <div class="hero-main-wrapper">
                            <div class="hero-content-left">
                                <h1 class="hero-main-title">
                                    {!! $banner->title !!}
                                </h1>
                                @if($banner->subtitle)
                                <p class="mb-4 text-muted">{{ $banner->subtitle }}</p>
                                @endif

                                @if($banner->stats_text)
                                <div class="hero-trust-badge">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Trusted By <strong>{{ $banner->stats_text }}</strong></span>
                                </div>
                                @endif

                                @if($banner->button_text && $banner->button_link)
                                <a href="{{ $banner->button_link }}" class="btn-hero-cta">
                                    {{ $banner->button_text }} <i class="fas fa-arrow-right"></i>
                                </a>
                                @endif
                            </div>
                            <div class="hero-content-right">
                                <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" class="hero-doctors-img">
                            </div>
                        </div>
                    </div>
                    @elseif($banner->type == 'image_only')
                    <!-- Image Only Slide -->
                    <div class="hero-slide-item">
                        <div class="hero-full-image" style="background-image: url('{{ asset($banner->image) }}'); height: 500px; background-size: cover; background-position: center; border-radius: 20px; position: relative;">
                            @if($banner->button_link)
                            <a href="{{ $banner->button_link }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></a>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
            @else
                <!-- Fallback Static Slides (Keep original if no dynamic banners) -->
                <!-- Slide 1 -->
                <div class="hero-slide-item">
                    <div class="hero-main-wrapper">
                        <div class="hero-content-left">
                            <h1 class="hero-main-title">
                                {!! $bannerSettings['banner_title'] ?? 'The Largest Online<br><span class="text-blue">Doctor Platform</span><br>Of The Country' !!}
                            </h1>
                            <div class="hero-trust-badge">
                                <i class="fas fa-check-circle"></i>
                                <span>Trusted By <strong>{{ $bannerSettings['banner_stats_text'] ?? '700,000' }}</strong> Patients</span>
                            </div>
                            <a href="{{ route('search') }}" class="btn-hero-cta">
                                Consult a Doctor Now <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="hero-content-right">
                            @if(!empty($bannerSettings['banner_image']))
                                <img src="{{ asset($bannerSettings['banner_image']) }}" alt="Professional Doctors" class="hero-doctors-img">
                            @else
                                <img src="{{ asset('assets/img/doctors-hero.png') }}" alt="Professional Doctors" class="hero-doctors-img">
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Other static slides can be removed or kept as backups -->
            @endif
        </div>

        <!-- Search Section -->
        <div class="hero-search-section">
            <!-- Main Search Bar -->
            <div class="hero-search-bar">
                <form action="{{ route('search') }}" class="hero-search-form" id="filterSearchForm">
                    <!-- District -->
                    <div class="search-field search-select">
                        <i class="fas fa-map-marker-alt"></i>
                        <select class="form-control" name="district_id" id="district_select">
                            <option value="">District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Area -->
                    <div class="search-field search-select">
                        <i class="fas fa-location-arrow"></i>
                        <select class="form-control" name="area_id" id="area_select" disabled>
                            <option value="">Area</option>
                        </select>
                    </div>

                    <!-- Speciality -->
                    <div class="search-field search-select">
                        <i class="fas fa-stethoscope"></i>
                        <select class="form-control" name="speciality_id" id="search_speciality">
                            <option value="">Speciality</option>
                            @foreach($searchSpecialities as $speciality)
                                <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Keyword Input (Search by doctor) -->
                    <div class="search-field search-keyword">
                        <i class="fas fa-search"></i>
                        <input type="text" name="keywords" placeholder="Search by doctor name/code" class="form-control">
                    </div>

                    <button type="submit" class="btn-hero-search">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Service Cards Removed -->
    </div>
</section>
<!-- /Home Banner -->

<!-- Doctor Registration CTA -->
<section class="section-doctor-cta">
    <div class="container">
        <div class="doctor-cta-wrapper">
            <div class="doctor-cta-content">
                <div class="doctor-cta-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="doctor-cta-text">
                    <h3>Are you a Doctor?</h3>
                    <p>Join thousands of doctors on our platform and grow your practice. Get more patients and manage your appointments easily.</p>
                </div>
            </div>
            <div class="doctor-cta-action">
                <a href="{{ route('doctor.register') }}" class="btn-doctor-register">
                    <i class="fas fa-stethoscope"></i> Register as Doctor
                </a>
            </div>
        </div>
    </div>
</section>
<!-- /Doctor Registration CTA -->

<!-- Video Section -->
<section class="section-video">
    <div class="container">
        <div class="section-header text-center">
            <h2>Watch How We Help You</h2>
            <p class="sub-title">See our platform in action and learn how easy it is to book appointments</p>
        </div>
        <div class="video-wrapper">
            <div class="video-container">
                <!-- Replace VIDEO_ID with your YouTube video ID -->
                <iframe
                    src="https://www.youtube.com/embed/8-8A8E-G4Co?rel=0"
                    title="Platform Introduction Video"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
</section>
<!-- /Video Section -->

<!-- Clinic and Specialities -->
{{-- <section class="section section-specialities">
    <div class="container">
        <div class="section-header text-center">
            <h2>Browse Top Specialities</h2>
            <p class="sub-title">Explore our wide range of trusted medical departments and find the right care for you.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <!-- Slider -->
                <div class="specialities-slider slider">
                    @foreach($searchSpecialities as $speciality)
                    <!-- Slider Item -->
                    <div class="speicality-item text-center">
                        <a href="{{ route('search', ['speciality_id' => $speciality->id]) }}" class="speciality-link">
                            <div class="speicality-img">
                                <img src="{{ asset($speciality->image) }}" class="img-fluid" alt="Speciality">
                                <span class="hover-icon"><i class="fas fa-chevron-right"></i></span>
                            </div>
                            <p>{{ $speciality->name }}</p>
                        </a>
                    </div>
                    <!-- /Slider Item -->
                    @endforeach
                </div>
                <!-- /Slider -->

            </div>
        </div>
    </div>
</section> --}}
<!-- Clinic and Specialities -->

<!-- Medical Products -->
<section class="section section-products" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="section-header text-center">
            <h2>Featured Medical Products</h2>
            <p class="sub-title">Order medicines and health products from our trusted pharmacy store.</p>
        </div>

        <div class="row">
            <!-- Sidebar Filter -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="product-filter-card">
                    <!-- Search -->
                    <div class="filter-section">
                        <h5 class="filter-title"><i class="fas fa-search"></i> Search</h5>
                        <div class="search-input-wrapper">
                            <input type="text" class="form-control" id="productSearchInput" placeholder="Search products...">
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="filter-section">
                        <h5 class="filter-title"><i class="fas fa-list"></i> Categories</h5>
                        <div class="category-list">
                            <label class="category-item">
                                <input type="radio" name="product_category" value="all" checked>
                                <span class="category-name">All Products</span>
                            </label>
                            @foreach($productCategories as $category)
                            <label class="category-item">
                                <input type="radio" name="product_category" value="{{ $category->id }}">
                                <span class="category-name">{{ $category->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Sidebar Filter -->

            <!-- Products Grid -->
            <div class="col-lg-9 col-md-8">
                <div class="row" id="productsGrid">
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4 product-grid-item">
                        <div class="product-card-modern">
                            <!-- Stock Badge -->
                            <div class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                {{ $product->stock > 0 ? 'IN STOCK' : 'OUT OF STOCK' }}
                            </div>

                            <!-- Product Image -->
                            <div class="product-image-container">
                                <a href="{{ route('products.show', $product->id) }}">
                                    @php
                                        $image = $product->image;
                                        if(!$image && !empty($product->gallery) && is_array($product->gallery)) {
                                            $image = $product->gallery[0] ?? null;
                                        }
                                    @endphp
                                    <img src="{{ $image ? asset($image) : asset('assets/img/products/product.jpg') }}" class="product-main-img" alt="{{ $product->name }}">
                                </a>
                            </div>

                            <!-- Product Details -->
                            <div class="product-details">
                                <!-- Rating -->
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <span class="rating-value">{{ number_format($product->rating ?? 4.5, 1) }}</span>
                                    <span class="review-count">({{ $product->reviews_count ?? rand(10, 200) }})</span>
                                </div>

                                <!-- Brand/Category -->
                                <div class="product-brand">{{ $product->category->name ?? 'Medicine' }}</div>

                                <!-- Title -->
                                <h4 class="product-name">
                                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                </h4>

                                <!-- Price & Actions -->
                                <div class="product-footer">
                                    <div class="product-price-tag">
                                        @if($product->sale_price)
                                            <span class="price-current">৳{{ number_format($product->sale_price, 0) }}</span>
                                            <span class="price-original">৳{{ number_format($product->price, 0) }}</span>
                                        @else
                                            <span class="price-current">৳{{ number_format($product->price, 0) }}</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST" class="product-actions-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <div class="btn-group-modern">
                                            <button type="submit" class="btn-cart-modern" title="Add to Cart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                            <button type="submit" name="buy_now" value="1" class="btn-buy-modern">
                                                Buy
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- View All Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('products') }}" class="btn-view-all-arrow">
                        View All Products <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <!-- /Products Grid -->
        </div>
    </div>
</section>
<!-- /Medical Products -->

<!-- Popular Doctors -->
<section class="section section-doctor" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="section-header text-center">
            <h2>Book Our Doctors</h2>
            <p class="sub-title">Meet our expert doctors and book your appointment today</p>
        </div>

        <div class="row">
            <!-- Sidebar Filter -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="doctor-filter-card">
                    <!-- Search -->
                    <div class="filter-section">
                        <h5 class="filter-title"><i class="fas fa-search"></i> Search Doctor</h5>
                        <div class="search-input-wrapper">
                            <input type="text" class="form-control" id="doctorSearchInput" placeholder="Search by name...">
                        </div>
                    </div>

                    <!-- Specialities -->
                    <div class="filter-section">
                        <h5 class="filter-title"><i class="fas fa-stethoscope"></i> Speciality</h5>
                        <div class="category-list">
                            <label class="category-item">
                                <input type="radio" name="doctor_speciality" value="all" checked>
                                <span class="category-name">All Doctors</span>
                            </label>
                            @foreach($searchSpecialities->take(6) as $speciality)
                            <label class="category-item">
                                <input type="radio" name="doctor_speciality" value="{{ $speciality->id }}">
                                <span class="category-name">{{ $speciality->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Sidebar Filter -->

            <!-- Doctors Grid -->
            <div class="col-lg-9 col-md-8">
                <div class="row" id="doctorsGrid">
                    @foreach($doctors as $doctor)
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4 doctor-grid-item">
                        <div class="doctor-card-new">
                            <div class="doctor-img-wrapper">
                                <a href="{{ route('doctor.profile', $doctor->id) }}">
                                    <img src="{{ $doctor->profile_image ? asset($doctor->profile_image) : asset('assets/img/doctors/doctor-thumb-01.jpg') }}" class="doctor-img" alt="{{ $doctor->user->name }}">
                                </a>
                                <div class="doctor-fee-badge">
                                    <span>৳ {{ $doctor->pricing === 'free' ? 'Free' : number_format($doctor->custom_price, 0) }}</span>
                                </div>
                            </div>
                            <div class="doctor-info">
                                <span class="doctor-speciality">{{ $doctor->speciality->name ?? 'General' }}</span>
                                <h4 class="doctor-name">
                                    <a href="{{ route('doctor.profile', $doctor->id) }}">Dr. {{ $doctor->user->name }}</a>
                                    <i class="fas fa-check-circle verified-badge" title="Verified"></i>
                                </h4>
                                <div class="doctor-rating">
                                    <i class="fas fa-star"></i>
                                    <span>{{ number_format($doctor->average_rating, 1) }}</span>
                                    <span class="rating-count">({{ $doctor->review_count }} reviews)</span>
                                </div>
                                <div class="doctor-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $doctor->clinic_name ?? ($doctor->area->name ?? 'Dhaka') }}</span>
                                </div>
                                <div class="doctor-buttons">
                                    <a href="{{ route('doctor.profile', $doctor->id) }}" class="btn-view-details">
                                        <i class="fas fa-user"></i> Details
                                    </a>
                                    <a href="{{ route('booking', $doctor->id) }}" class="btn-book-appointment">
                                        <i class="fas fa-calendar-check"></i> Appointment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- View All Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('search') }}" class="btn-view-all-arrow">
                        View All Doctors <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <!-- /Doctors Grid -->
        </div>
    </div>
</section>
<!-- /Popular Doctors -->

<!-- Health Packages Section -->
<section class="section section-health-packages" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); padding: 80px 0;">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center mb-5">
            <span class="badge badge-soft-blue mb-3">Health Packages</span>
            <h2 class="mb-3">Choose Your Health Package</h2>
            <p class="text-muted">Comprehensive health checkup packages at affordable prices</p>
        </div>

        <!-- Packages Grid -->
        <div class="row justify-content-center">
            <!-- Basic Package -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="health-package-card">
                    <div class="package-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <div class="package-badge">Basic</div>
                    <h4 class="package-title">Basic Health Checkup</h4>
                    <p class="package-tests"><i class="fas fa-vial"></i> 15+ Tests Included</p>
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> Blood Sugar Test</li>
                        <li><i class="fas fa-check"></i> Lipid Profile</li>
                        <li><i class="fas fa-check"></i> Liver Function</li>
                        <li><i class="fas fa-check"></i> Kidney Function</li>
                    </ul>
                    <div class="package-price">
                        <span class="price">৳1,500</span>
                        <span class="period">one-time</span>
                    </div>
                    <a href="{{ route('products') }}" class="btn-package">
                        Book Now <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Standard Package -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="health-package-card featured">
                    <div class="featured-ribbon">Most Popular</div>
                    <div class="package-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="package-badge">Standard</div>
                    <h4 class="package-title">Full Body Checkup</h4>
                    <p class="package-tests"><i class="fas fa-vial"></i> 40+ Tests Included</p>
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> Complete Blood Count</li>
                        <li><i class="fas fa-check"></i> Thyroid Profile</li>
                        <li><i class="fas fa-check"></i> Vitamin Tests</li>
                        <li><i class="fas fa-check"></i> ECG & X-Ray</li>
                    </ul>
                    <div class="package-price">
                        <span class="price">৳3,500</span>
                        <span class="period">one-time</span>
                    </div>
                    <a href="{{ route('products') }}" class="btn-package">
                        Book Now <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Premium Package -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="health-package-card">
                    <div class="package-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <div class="package-badge">Premium</div>
                    <h4 class="package-title">Executive Checkup</h4>
                    <p class="package-tests"><i class="fas fa-vial"></i> 70+ Tests Included</p>
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> Full Body Screening</li>
                        <li><i class="fas fa-check"></i> Cardiac Risk Markers</li>
                        <li><i class="fas fa-check"></i> Cancer Markers</li>
                        <li><i class="fas fa-check"></i> Doctor Consultation</li>
                    </ul>
                    <div class="package-price">
                        <span class="price">৳7,000</span>
                        <span class="period">one-time</span>
                    </div>
                    <a href="{{ route('products') }}" class="btn-package">
                        Book Now <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Diabetes Package -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="health-package-card">
                    <div class="package-icon">
                        <i class="fas fa-tint"></i>
                    </div>
                    <div class="package-badge">Specialized</div>
                    <h4 class="package-title">Diabetes Care</h4>
                    <p class="package-tests"><i class="fas fa-vial"></i> 25+ Tests Included</p>
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> HbA1c Test</li>
                        <li><i class="fas fa-check"></i> Fasting Blood Sugar</li>
                        <li><i class="fas fa-check"></i> Insulin Level</li>
                        <li><i class="fas fa-check"></i> Kidney Profile</li>
                    </ul>
                    <div class="package-price">
                        <span class="price">৳2,500</span>
                        <span class="period">one-time</span>
                    </div>
                    <a href="{{ route('products') }}" class="btn-package">
                        Book Now <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- View All Button -->
        <div class="text-center mt-4">
            <a href="{{ route('products') }}" class="btn-view-all-arrow">
                View All Packages <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<!-- /Health Packages Section -->
<!-- Video Section -->
<section class="section section-video-promo">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="video-promo-content">
                    <span class="badge badge-soft-blue mb-3">Health First</span>
                    <h2 class="mb-4">We Are Always Here For Your Health</h2>
                    <p class="mb-4 text-muted">Doccure provides progressive, and affordable healthcare, accessible on mobile and online for everyone. To us, it's not just work. We take pride in the solutions we deliver</p>

                    <ul class="video-promo-list list-unstyled mb-4">
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Leading Healthcare Provider</li>
                        <li><i class="fas fa-check-circle text-primary me-2"></i> 24/7 Support Available</li>
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Experienced Doctors</li>
                    </ul>

                    <a href="{{ route('search') }}" class="btn btn-primary">Book Now</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="video-promo-box">
                    <img src="{{ asset('assets/img/features/feature.png') }}" alt="Video Thumbnail" class="img-fluid rounded-lg shadow-lg">
                    <a href="https://www.youtube.com/watch?v=Nu6Z42pKLri" data-fancybox class="video-play-btn">
                        <i class="fas fa-play"></i>
                        <span class="video-ripple ripple-1"></span>
                        <span class="video-ripple ripple-2"></span>
                        <span class="video-ripple ripple-3"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Video Section -->

<!-- Services Section -->
<section class="section section-services">
    <div class="container">
        <div class="section-header text-center">
            <h2>Our Services</h2>
            <p class="sub-title">We provide the best quality healthcare services.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-6">
                <div class="service-box">
                    <div class="service-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h4>Medical</h4>
                    <p>Comprehensive medical care with state-of-the-art facilities and expert physicians.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="service-box">
                    <div class="service-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h4>Laboratory</h4>
                    <p>Advanced diagnostic laboratory for accurate and timely test results.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="service-box">
                    <div class="service-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h4>ICU Service</h4>
                    <p>24/7 Intensive Care Unit with specialized monitoring and support.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="service-box">
                    <div class="service-icon">
                        <i class="fas fa-procedures"></i>
                    </div>
                    <h4>Operation</h4>
                    <p>Modern operation theaters equipped for complex surgical procedures.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="service-box">
                    <div class="service-icon">
                        <i class="fas fa-vials"></i>
                    </div>
                    <h4>Test Room</h4>
                    <p>Dedicated rooms for various specialized medical tests and screenings.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="service-box">
                    <div class="service-icon">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <h4>Patient Ward</h4>
                    <p>Comfortable and hygienic wards for optimal patient recovery.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Services Section -->

<!-- Blog Section -->
<section class="section section-blogs" style="background-color: #ffff;">
    <div class="container">
        <div class="section-header text-center">
            <h2>Latest Blogs & News</h2>
            <p class="sub-title">Stay updated with our latest health tips and news.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3 col-sm-12">
                <div class="blog-grid">
                    <div class="blog-grid-img">
                        <a href="#">
                            <img src="{{ asset('assets/img/blog/blog-01.jpg') }}" class="img-fluid" alt="Blog Image">
                        </a>
                    </div>
                    <div class="blog-grid-info">
                        <div class="blog-date">05 Sep 2025</div>
                        <h4 class="blog-title"><a href="#">How to Handle Patient Health?</a></h4>
                        <p class="blog-text">Learn the best practices for managing patient health effectively...</p>
                        <a href="#" class="read-more-btn">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-12">
                <div class="blog-grid">
                    <div class="blog-grid-img">
                        <a href="#">
                            <img src="{{ asset('assets/img/blog/blog-02.jpg') }}" class="img-fluid" alt="Blog Image">
                        </a>
                    </div>
                    <div class="blog-grid-info">
                        <div class="blog-date">06 Sep 2025</div>
                        <h4 class="blog-title"><a href="#">The Benefits of Regular Checkups</a></h4>
                        <p class="blog-text">Regular health checkups are vital for early detection and prevention...</p>
                        <a href="#" class="read-more-btn">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-12">
                <div class="blog-grid">
                    <div class="blog-grid-img">
                        <a href="#">
                            <img src="{{ asset('assets/img/blog/blog-03.jpg') }}" class="img-fluid" alt="Blog Image">
                        </a>
                    </div>
                    <div class="blog-grid-info">
                        <div class="blog-date">07 Sep 2025</div>
                        <h4 class="blog-title"><a href="#">Healthy Living Tips</a></h4>
                        <p class="blog-text">Simple lifestyle changes can lead to significant health improvements...</p>
                        <a href="#" class="read-more-btn">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-12">
                <div class="blog-grid">
                    <div class="blog-grid-img">
                        <a href="#">
                            <img src="{{ asset('assets/img/blog/blog-04.jpg') }}" class="img-fluid" alt="Blog Image">
                        </a>
                    </div>
                    <div class="blog-grid-info">
                        <div class="blog-date">08 Sep 2025</div>
                        <h4 class="blog-title"><a href="#">Understanding Mental Health</a></h4>
                        <p class="blog-text">Mental health is just as important as physical health. Find out why...</p>
                        <a href="#" class="read-more-btn">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="view-all text-center mt-4">
            <a href="#" class="btn btn-outline-primary">View All Blogs</a>
        </div>
    </div>
</section>
<!-- /Blog Section -->

<!-- How It Works -->
<section class="section section-how-it-works" style="background-color: #f9faff;">
    <div class="container">
        <div class="section-header text-center">
            <h2>How It Works</h2>
            <p class="sub-title">Get started with just a few simple steps</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center border-0 shadow-sm h-100 how-it-works-card" style="border-radius: 15px;">
                    <div class="card-body py-5">
                        <div class="mb-4">
                            <span style="font-size: 50px; color: #1D4ED8;"><i class="fas fa-search"></i></span>
                        </div>
                        <h5 class="card-title font-weight-bold">Search Doctor</h5>
                        <p class="card-text text-muted">Find the right doctor by specialty, name, or location.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center border-0 shadow-sm h-100 how-it-works-card" style="border-radius: 15px;">
                    <div class="card-body py-5">
                        <div class="mb-4">
                            <span style="font-size: 50px; color: #1D4ED8;"><i class="fas fa-user-check"></i></span>
                        </div>
                        <h5 class="card-title font-weight-bold">Check Profile</h5>
                        <p class="card-text text-muted">View doctor's qualifications, reviews, and experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center border-0 shadow-sm h-100 how-it-works-card" style="border-radius: 15px;">
                    <div class="card-body py-5">
                        <div class="mb-4">
                            <span style="font-size: 50px; color: #1D4ED8;"><i class="fas fa-calendar-check"></i></span>
                        </div>
                        <h5 class="card-title font-weight-bold">Book Appointment</h5>
                        <p class="card-text text-muted">Select a convenient time slot and book your visit.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center border-0 shadow-sm h-100 how-it-works-card" style="border-radius: 15px;">
                    <div class="card-body py-5">
                        <div class="mb-4">
                            <span style="font-size: 50px; color: #1D4ED8;"><i class="fas fa-notes-medical"></i></span>
                        </div>
                        <h5 class="card-title font-weight-bold">Get Consultation</h5>
                        <p class="card-text text-muted">Visit the doctor and receive quality care.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /How It Works -->

<!-- Statistics Section -->
<section class="section section-stats" style="background: linear-gradient(135deg, #1D4ED8 0%, #60A5FA 100%); padding: 60px 0;">
    <div class="container">
        <div class="row text-center text-white">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="counter-box">
                    <h2 class="display-4 font-weight-bold mb-2"><i class="fas fa-user-md me-2"></i>500+</h2>
                    <p class="mb-0" style="font-size: 18px;">Expert Doctors</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="counter-box">
                    <h2 class="display-4 font-weight-bold mb-2"><i class="fas fa-users me-2"></i>10K+</h2>
                    <p class="mb-0" style="font-size: 18px;">Happy Patients</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="counter-box">
                    <h2 class="display-4 font-weight-bold mb-2"><i class="fas fa-hospital me-2"></i>100+</h2>
                    <p class="mb-0" style="font-size: 18px;">Clinics & Hospitals</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-box">
                    <h2 class="display-4 font-weight-bold mb-2"><i class="fas fa-award me-2"></i>15+</h2>
                    <p class="mb-0" style="font-size: 18px;">Years of Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Statistics Section -->

<!-- Testimonials Section -->
<section class="section section-specialities">
    <div class="container">
        <div class="section-header text-center">
            <h2>What Our Patients Say</h2>
            <p class="sub-title">Real feedback from our valued patients</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text text-muted">"Excellent service! The doctor was very professional and the booking process was seamless. Highly recommend Doccure to everyone."</p>
                        <div class="d-flex align-items-center mt-4">
                            <img src="{{ asset('assets/img/patients/patient1.jpg') }}" class="rounded-circle me-3" alt="Patient" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0 font-weight-bold">Sarah Johnson</h6>
                                <small class="text-muted">Cardiology Patient</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text text-muted">"Found the best dentist through Doccure. The platform is easy to use and the doctor profiles are very detailed. Great experience!"</p>
                        <div class="d-flex align-items-center mt-4">
                            <img src="{{ asset('assets/img/patients/patient2.jpg') }}" class="rounded-circle me-3" alt="Patient" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0 font-weight-bold">Michael Chen</h6>
                                <small class="text-muted">Dental Patient</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                        </div>
                        <p class="card-text text-muted">"Very convenient way to book appointments. No more waiting in long queues. The reminder system is also very helpful."</p>
                        <div class="d-flex align-items-center mt-4">
                            <img src="{{ asset('assets/img/patients/patient3.jpg') }}" class="rounded-circle me-3" alt="Patient" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0 font-weight-bold">Emily Davis</h6>
                                <small class="text-muted">General Checkup</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Testimonials Section -->

<!-- Call to Action -->
<!-- Call to Action -->
<section class="section-cta">
    <div class="cta-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    <div class="container text-center position-relative z-index-1">
        <h2 class="display-5 font-weight-bold mb-3 text-white">Ready to Book Your Appointment?</h2>
        <p class="lead mb-5 text-white-50">Join thousands of patients who trust Doccure for their healthcare needs.</p>
        <a href="{{ route('search') }}" class="btn btn-light cta-btn">
            <i class="fas fa-calendar-check me-2"></i> Find a Doctor Now
        </a>
    </div>
</section>
<!-- /Call to Action -->
<!-- /Call to Action -->

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Hero Slider Initialization - Explicit Call
    if($('.hero-slider').length > 0) {
        $('.hero-slider').slick({
            dots: false,
            autoplay: true,
            autoplaySpeed: 4000,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false
                }
            }]
        });
        console.log('Hero Slider Initialized Successfully');
    }

    // Initialize Select2 on new banner search dropdowns
    $('.search-input-group select').select2({
        minimumResultsForSearch: 5,
        width: '100%',
        dropdownAutoWidth: true
    });

    // District change handler for area loading
    $('#district_select').on('change', function() {
        var districtId = $(this).val();
        var areaSelect = $('#area_select');

        areaSelect.empty().append('<option value="">Loading...</option>').trigger('change');

        if (districtId) {
            $.ajax({
                url: '/api/areas/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function(areas) {
                    areaSelect.empty().append('<option value="">Area</option>');
                    $.each(areas, function(key, area) {
                        areaSelect.append('<option value="' + area.id + '">' + area.name + '</option>');
                    });
                    areaSelect.prop('disabled', false).trigger('change');
                },
                error: function() {
                    areaSelect.empty().append('<option value="">Area</option>');
                    areaSelect.prop('disabled', true).trigger('change');
                }
            });
        } else {
            areaSelect.empty().append('<option value="">Area</option>');
            areaSelect.prop('disabled', true).trigger('change');
        }
    });

    // Product filtering functionality
    var searchTimeout;

    function filterProducts() {
        var category = $('input[name="product_category"]:checked').val();
        var search = $('#productSearchInput').val();

        $.ajax({
            url: '/api/products/filter',
            type: 'GET',
            data: { category: category, search: search },
            success: function(products) {
                renderProducts(products);
            }
        });
    }

    function renderProducts(products) {
        var grid = $('#productsGrid');
        grid.empty();

        if (products.length === 0) {
            grid.html('<div class="col-12"><div class="alert alert-info text-center">No products found.</div></div>');
            return;
        }

        products.forEach(function(product) {
            var imageSrc = product.image ? (product.image.startsWith('http') ? product.image : '/' + product.image) : '/assets/img/products/product.jpg';

            var priceHtml = '';
            if (product.sale_price) {
                priceHtml = '<span class="price-current">৳' + numberFormat(product.sale_price) + '</span>' +
                           '<span class="price-original">৳' + numberFormat(product.price) + '</span>';
            } else {
                priceHtml = '<span class="price-current">৳' + numberFormat(product.price) + '</span>';
            }

            var stockClass = (product.stock > 0) ? 'in-stock' : 'out-of-stock';
            var stockText = (product.stock > 0) ? 'IN STOCK' : 'OUT OF STOCK';
            var rating = product.rating || 4.5;
            var reviewCount = product.reviews_count || Math.floor(Math.random() * 190) + 10;
            var categoryName = product.category ? product.category.name : 'Medicine';

            var html = `
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4 product-grid-item">
                    <div class="product-card-modern">
                        <div class="stock-badge ${stockClass}">${stockText}</div>
                        <div class="product-image-container">
                            <a href="/products/${product.id}">
                                <img src="${imageSrc}" class="product-main-img" alt="${product.name}">
                            </a>
                        </div>
                        <div class="product-details">
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <span class="rating-value">${rating.toFixed(1)}</span>
                                <span class="review-count">(${reviewCount})</span>
                            </div>
                            <div class="product-brand">${categoryName}</div>
                            <h4 class="product-name">
                                <a href="/products/${product.id}">${product.name}</a>
                            </h4>
                            <div class="product-footer">
                                <div class="product-price-tag">${priceHtml}</div>
                                <form action="/cart/add" method="POST" class="product-actions-form">
                                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                    <input type="hidden" name="product_id" value="${product.id}">
                                    <input type="hidden" name="quantity" value="1">
                                    <div class="btn-group-modern">
                                        <button type="submit" class="btn-cart-modern" title="Add to Cart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button type="submit" name="buy_now" value="1" class="btn-buy-modern">
                                            Buy
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            grid.append(html);
        });
    }

    function numberFormat(num) {
        return Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Category filter change
    $('input[name="product_category"]').on('change', function() {
        filterProducts();
    });

    // Search input with debounce
    $('#productSearchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            filterProducts();
        }, 300);
    });
    // Doctor filtering functionality
    var doctorSearchTimeout;

    function filterDoctors() {
        var speciality = $('input[name="doctor_speciality"]:checked').val();
        var search = $('#doctorSearchInput').val();

        $.ajax({
            url: '/api/doctors/filter',
            type: 'GET',
            data: { speciality: speciality, search: search },
            success: function(doctors) {
                renderDoctors(doctors);
            }
        });
    }

    function renderDoctors(doctors) {
        var grid = $('#doctorsGrid');
        grid.empty();

        if (doctors.length === 0) {
            grid.html('<div class="col-12"><div class="alert alert-info text-center">No doctors found.</div></div>');
            return;
        }

        doctors.forEach(function(doctor) {
            var imageSrc = doctor.profile_image ? '/storage/' + doctor.profile_image : '/assets/img/doctors/doctor-thumb-01.jpg';
            var fee = doctor.pricing === 'free' ? 'Free' : '৳ ' + numberFormat(doctor.custom_price || 0);

            var html = `
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4 doctor-grid-item">
                    <div class="doctor-card-new">
                        <div class="doctor-img-wrapper">
                            <a href="/doctor-profile/${doctor.id}">
                                <img src="${imageSrc}" class="doctor-img" alt="${doctor.name}">
                            </a>
                            <div class="doctor-fee-badge">
                                <span>${fee}</span>
                            </div>
                        </div>
                        <div class="doctor-info">
                            <span class="doctor-speciality">${doctor.speciality}</span>
                            <h4 class="doctor-name">
                                <a href="/doctor-profile/${doctor.id}">Dr. ${doctor.name}</a>
                                <i class="fas fa-check-circle verified-badge" title="Verified"></i>
                            </h4>
                            <div class="doctor-rating">
                                <i class="fas fa-star"></i>
                                <span>${parseFloat(doctor.average_rating || 0).toFixed(1)}</span>
                                <span class="rating-count">(${doctor.review_count || 0} reviews)</span>
                            </div>
                            <div class="doctor-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>${doctor.clinic_name || doctor.area_name}</span>
                            </div>
                            <div class="doctor-buttons">
                                <a href="/doctor-profile/${doctor.id}" class="btn-view-details">
                                    <i class="fas fa-user"></i> Details
                                </a>
                                <a href="/booking/${doctor.id}" class="btn-book-appointment">
                                    <i class="fas fa-calendar-check"></i> Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            grid.append(html);
        });
    }

    // Doctor speciality filter change
    $('input[name="doctor_speciality"]').on('change', function() {
        filterDoctors();
    });

    // Doctor search input with debounce
    $('#doctorSearchInput').on('keyup', function() {
        clearTimeout(doctorSearchTimeout);
        doctorSearchTimeout = setTimeout(function() {
            filterDoctors();
        }, 300);
    });
});
</script>
@endpush

@push('styles')
<style>
/* Header For Doctors Button */
.btn-for-doctors {
    border: 2px solid #28a745 !important;
    color: #28a745 !important;
    border-radius: 25px !important;
    padding: 8px 18px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    margin-right: 10px;
}

.btn-for-doctors:hover {
    background: #28a745 !important;
    color: #fff !important;
}

.btn-for-doctors i {
    margin-right: 5px;
}

/* Doctor Registration CTA Section */
.section-doctor-cta {
    background: linear-gradient(135deg, #1D4ED8 0%, #60A5FA 100%);
    padding: 25px 0;
    position: relative;
    overflow: hidden;
    max-width: 1320px;
    margin: 20px auto;
    border-radius: 20px;
}

.section-doctor-cta::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}

.section-doctor-cta::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 200px;
    height: 200px;
    background: rgba(255,255,255,0.08);
    border-radius: 50%;
}

.doctor-cta-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
    position: relative;
    z-index: 1;
}

.doctor-cta-content {
    display: flex;
    align-items: center;
    gap: 20px;
}

.doctor-cta-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.doctor-cta-icon i {
    font-size: 28px;
    color: #fff;
}

.doctor-cta-text h3 {
    color: #fff;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 5px;
}

.doctor-cta-text p {
    color: rgba(255,255,255,0.85);
    font-size: 14px;
    margin: 0;
    max-width: 500px;
}

.btn-doctor-register {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 30px;
    background: #fff;
    color: #1D4ED8;
    border-radius: 50px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.btn-doctor-register:hover {
    background: #272b41;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.25);
    text-decoration: none;
}

.btn-doctor-register i {
    font-size: 18px;
}

@media (max-width: 768px) {
    .doctor-cta-wrapper {
        flex-direction: column;
        text-align: center;
    }

    .doctor-cta-content {
        flex-direction: column;
    }

    .doctor-cta-text p {
        max-width: 100%;
    }
}

/* Video Section */
.section-video {
    background: linear-gradient(180deg, #e8f4fc 0%, #f0f9ff 100%);
    padding: 60px 0;
    margin: 20px 0;
}

.section-video .section-header h2 {
    color: #272b41;
    font-weight: 700;
    margin-bottom: 10px;
}

.section-video .section-header .sub-title {
    color: #6c757d;
    font-size: 16px;
    margin-bottom: 40px;
}

.video-wrapper {
    max-width: 900px;
    margin: 0 auto;
}

.video-container {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0 15px 50px rgba(0,102,255,0.15);
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 20px;
}

/* Product Filter Card */
.product-filter-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    padding: 25px;
    position: sticky;
    top: 100px;
}

.filter-section {
    margin-bottom: 25px;
}

.filter-section:last-child {
    margin-bottom: 0;
}

.filter-title {
    font-size: 16px;
    font-weight: 600;
    color: #272b41;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-title i {
    color: #1D4ED8;
}

.search-input-wrapper input {
    border-radius: 10px;
    padding: 12px 15px;
    border: 1px solid #e8e8e8;
    transition: all 0.3s;
}

.search-input-wrapper input:focus {
    border-color: #1D4ED8;
    box-shadow: 0 0 0 3px rgba(0,102,255,0.1);
}

/* Category List */
.category-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.category-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    margin: 0;
}

.category-item:hover {
    background: #f5f8ff;
}

.category-item input[type="radio"] {
    width: 18px;
    height: 18px;
    accent-color: #1D4ED8;
}

.category-item .category-name {
    font-size: 14px;
    color: #555;
}

.category-item input:checked + .category-name {
    color: #1D4ED8;
    font-weight: 600;
}

/* Product Card Modern */
.section-products .row {
    margin: 0 -10px;
}

.section-products .product-grid-item {
    padding: 0 10px;
}

.product-card-modern {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    border: 1px solid #f0f0f0;
}

.product-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 35px rgba(0,102,255,0.12);
}

/* Stock Badge */
.stock-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.5px;
    z-index: 10;
    text-transform: uppercase;
}

.stock-badge.in-stock {
    background: #e8f5e9;
    color: #2e7d32;
}

.stock-badge.out-of-stock {
    background: #ffebee;
    color: #c62828;
}

/* Product Image */
.product-image-container {
    position: relative;
    height: 180px;
    overflow: hidden;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.product-main-img {
    max-width: 100%;
    max-height: 140px;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.product-card-modern:hover .product-main-img {
    transform: scale(1.05);
}

/* Product Details */
.product-details {
    padding: 16px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Rating */
.product-rating {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 8px;
    font-size: 13px;
}

.product-rating i {
    color: #ffc107;
    font-size: 12px;
}

.product-rating .rating-value {
    font-weight: 600;
    color: #333;
}

.product-rating .review-count {
    color: #999;
    font-size: 12px;
}

/* Brand */
.product-brand {
    font-size: 11px;
    color: #1D4ED8;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

/* Product Name */
.product-name {
    font-size: 14px;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 40px;
}

.product-name a {
    color: #272b41;
    text-decoration: none;
    transition: color 0.2s;
}

.product-name a:hover {
    color: #1D4ED8;
}

/* Product Footer - Price & Buttons */
.product-footer {
    margin-top: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.product-price-tag {
    display: flex;
    flex-direction: column;
}

.price-current {
    font-size: 18px;
    font-weight: 700;
    color: #272b41;
}

.price-original {
    font-size: 12px;
    color: #999;
    text-decoration: line-through;
}

/* Button Group */
.product-actions-form {
    display: flex;
}

.btn-group-modern {
    display: flex;
    gap: 6px;
}

.btn-cart-modern {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    border: 2px solid #1D4ED8;
    background: transparent;
    color: #1D4ED8;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-cart-modern:hover {
    background: #1D4ED8;
    color: #fff;
}

.btn-buy-modern {
    padding: 0 20px;
    height: 38px;
    border-radius: 8px;
    border: none;
    background: linear-gradient(135deg, #1D4ED8 0%, #60A5FA 100%);
    color: #fff;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-buy-modern:hover {
    background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,102,255,0.3);
}

/* View All Button */
.view-all-btn {
    padding: 10px 30px;
    border-radius: 50px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s;
}

.view-all-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,102,255,0.3);
}

/* Arrow Animation Button */
.btn-view-all-arrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 28px;
    background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(29, 78, 216, 0.3);
}

.btn-view-all-arrow i {
    transition: transform 0.3s ease;
}

.btn-view-all-arrow:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(29, 78, 216, 0.4);
}

.btn-view-all-arrow:hover i {
    transform: translateX(6px);
}

/* =====================================
   HEALTH PACKAGES SECTION
===================================== */
.health-package-card {
    background: #fff;
    border-radius: 20px;
    padding: 30px 25px;
    text-align: center;
    box-shadow: 0 5px 25px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    border: 2px solid transparent;
}

.health-package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(29, 78, 216, 0.15);
    border-color: #1D4ED8;
}

.health-package-card.featured {
    border: 2px solid #1D4ED8;
    transform: scale(1.02);
}

.health-package-card.featured:hover {
    transform: scale(1.02) translateY(-10px);
}

.featured-ribbon {
    position: absolute;
    top: 15px;
    right: -35px;
    background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
    color: #fff;
    padding: 5px 40px;
    font-size: 11px;
    font-weight: 600;
    transform: rotate(45deg);
    box-shadow: 0 2px 10px rgba(29, 78, 216, 0.3);
}

.package-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.package-icon i {
    font-size: 28px;
    color: #1D4ED8;
}

.package-badge {
    display: inline-block;
    background: #EEF2FF;
    color: #1D4ED8;
    padding: 4px 15px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
}

.package-title {
    font-size: 18px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 10px;
}

.package-tests {
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 20px;
}

.package-tests i {
    color: #1D4ED8;
    margin-right: 5px;
}

.package-features {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
    text-align: left;
}

.package-features li {
    padding: 8px 0;
    font-size: 13px;
    color: #4b5563;
    border-bottom: 1px solid #f3f4f6;
}

.package-features li:last-child {
    border-bottom: none;
}

.package-features li i {
    color: #10b981;
    margin-right: 10px;
    font-size: 12px;
}

.package-price {
    margin: auto 0 20px 0;
    padding-top: 15px;
}

.package-price .price {
    font-size: 32px;
    font-weight: 700;
    color: #1D4ED8;
}

.package-price .period {
    display: block;
    font-size: 12px;
    color: #9ca3af;
    margin-top: 2px;
}

.btn-package {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px 20px;
    background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-package:hover {
    color: #fff;
    box-shadow: 0 5px 20px rgba(29, 78, 216, 0.4);
    transform: translateY(-2px);
}

.btn-package i {
    transition: transform 0.3s ease;
}

.btn-package:hover i {
    transform: translateX(5px);
}

/* Responsive */
@media (max-width: 768px) {
    .product-filter-card,
    .doctor-filter-card {
        position: static;
        margin-bottom: 20px;
    }
}

/* Legacy Product Card Styles (for backward compatibility) */
.product-card-new:hover .product-img {
    transform: scale(1.05);
}

.product-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

.badge-discount {
    background: #ff4d4d;
    color: #fff;
}

.badge-featured {
    background: #1D4ED8;
    color: #fff;
}

.product-info {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-category {
    font-size: 11px;
    color: #1D4ED8;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
    font-weight: 600;
}

.product-title {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 12px;
    line-height: 1.5;
    min-height: 45px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-title a {
    color: #272b41;
    text-decoration: none;
}

.product-title a:hover {
    color: #1D4ED8;
}

.product-price {
    margin-bottom: 15px;
    min-height: 28px;
}

.current-price {
    font-size: 20px;
    font-weight: 700;
    color: #1D4ED8;
}

.original-price {
    font-size: 14px;
    color: #999;
    text-decoration: line-through;
    margin-left: 8px;
}

/* Button Styles */
.btn-add-cart, .btn-buy-now {
    width: 100%;
    padding: 8px 5px; /* Reduced side padding to prevent overflow */
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: auto;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 38px; /* Fixed height alignment */
}

/* Add to Cart Button */
.btn-add-cart {
    background: linear-gradient(135deg, #1D4ED8, #60A5FA);
    border: none;
    color: #fff;
}

.btn-add-cart:hover {
    background: linear-gradient(135deg, #1E40AF, #3B82F6);
    transform: translateY(-2px);
    color: #fff;
}

/* Buy Now Button */
.btn-buy-now {
    background: #fff;
    border: 1px solid #1D4ED8; /* Thinner border */
    color: #1D4ED8;
}

.btn-buy-now:hover {
    background: #1D4ED8;
    color: #fff;
    transform: translateY(-2px);
}

.btn-add-cart i, .btn-buy-now i {
    margin-right: 4px;
    font-size: 12px;
}

/* View All Button */
.view-all-btn {
    padding: 10px 30px;
    border-radius: 50px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s;
}

.view-all-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,102,255,0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .product-filter-card,
    .doctor-filter-card {
        position: static;
        margin-bottom: 20px;
    }

    .category-list {
        flex-direction: row;
        flex-wrap: wrap;
    }

    .category-item {
        flex: 0 0 auto;
    }
}

/* Doctor Filter Card */
.doctor-filter-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    padding: 25px;
    position: sticky;
    top: 100px;
}

/* Doctor Card New */
.section-doctor .row {
    margin: 0 -10px;
}

.section-doctor .doctor-grid-item {
    padding: 0 10px;
}

.doctor-card-new {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    overflow: hidden;
    transition: all 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #f0f0f0;
}

.doctor-card-new:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,102,255,0.15);
    border-color: #1D4ED8;
}

.doctor-img-wrapper {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: linear-gradient(135deg, #e8f4ff 0%, #f0f8ff 100%);
}

.doctor-img-wrapper .doctor-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.doctor-card-new:hover .doctor-img {
    transform: scale(1.05);
}

.doctor-fee-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #1D4ED8, #60A5FA);
    color: #fff;
    padding: 8px 15px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 14px;
    box-shadow: 0 4px 15px rgba(0,102,255,0.3);
}

.doctor-info {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.doctor-speciality {
    font-size: 11px;
    color: #1D4ED8;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
    font-weight: 600;
    display: inline-block;
    background: #e8f4ff;
    padding: 4px 10px;
    border-radius: 20px;
    width: fit-content;
}

.doctor-name {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 10px;
    line-height: 1.4;
    min-height: 25px;
}

.doctor-name a {
    color: #272b41;
    text-decoration: none;
}

.doctor-name a:hover {
    color: #1D4ED8;
}

.verified-badge {
    color: #1D4ED8;
    font-size: 14px;
    margin-left: 5px;
}

.doctor-rating {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 10px;
    font-size: 14px;
}

.doctor-rating i {
    color: #ffc107;
}

.doctor-rating .rating-count {
    color: #888;
    font-size: 12px;
}

.doctor-location {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
    font-size: 13px;
    color: #666;
}

.doctor-location i {
    color: #1D4ED8;
}
/* Doctor Buttons Container */
.doctor-buttons {
    display: flex;
    gap: 10px;
    margin-top: auto;
}

.btn-view-details {
    flex: 1;
    padding: 10px 8px;
    background: transparent;
    border: 2px solid #1D4ED8;
    border-radius: 8px;
    color: #1D4ED8;
    font-weight: 600;
    font-size: 12px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-view-details:hover {
    background: #1D4ED8;
    color: #fff;
    text-decoration: none;
}

.btn-view-details i {
    margin-right: 4px;
}

.btn-book-appointment {
    flex: 1;
    padding: 10px 8px;
    background: linear-gradient(135deg, #1D4ED8, #60A5FA);
    border: none;
    border-radius: 8px;
    color: #fff;
    font-weight: 600;
    font-size: 12px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-book-appointment:hover {
    background: linear-gradient(135deg, #1E40AF, #3B82F6);
    transform: translateY(-2px);
    color: #fff;
    text-decoration: none;
    box-shadow: 0 8px 25px rgba(0,102,255,0.3);
}

.btn-book-appointment i {
    margin-right: 4px;
}
</style>
@endpush


