@extends('layouts.app')

@section('title', 'Doccure - Doctor Appointment Booking')

@section('content')
<!-- Home Banner -->
<section class="section section-search-new">
    <!-- Decorative Elements -->
    <div class="hero-dots"></div>
    <div class="hero-cross hero-cross-1">+</div>
    <div class="hero-cross hero-cross-2">+</div>

    <div class="container">
        <div class="banner-wrapper-new">
            <!-- Left Content -->
            <div class="banner-content-left">
                <h1 class="banner-headline">
                    Get best <span class="text-highlight">quality</span><br>
                    health <span class="text-highlight">care</span> services<br>
                    at reasonable cost
                </h1>

                <p class="banner-subtitle">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                </p>

                <!-- Feature Highlights -->
                <div class="feature-highlights">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Reasonable cost</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Qualified doctor</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Hi-tech machine</span>
                    </div>
                </div>
            </div>

            <!-- Right Image -->
            <div class="banner-content-right">
                <img src="{{ asset('assets/img/doctors-hero.png') }}" alt="Professional Doctors" class="hero-doctors-img">
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-section-new">
            <!-- Filter Search: Speciality, District, Area -->
            <div class="search-container-new">
                <form action="{{ route('search') }}" class="search-form-new" id="filterSearchForm">
                    <!-- Speciality -->
                    <div class="search-input-group">
                        <i class="fas fa-stethoscope search-icon"></i>
                        <select class="form-control" name="speciality_id" id="search_speciality">
                            <option value="">Speciality</option>
                            @foreach($searchSpecialities as $speciality)
                                <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- District -->
                    <div class="search-input-group">
                        <i class="fas fa-map-marker-alt search-icon"></i>
                        <select class="form-control" name="district_id" id="district_select">
                            <option value="">District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Area -->
                    <div class="search-input-group location-group">
                        <i class="fas fa-location-arrow search-icon"></i>
                        <select class="form-control" name="area_id" id="area_select" disabled>
                            <option value="">Area</option>
                        </select>
                    </div>

                    <button type="submit" class="btn search-btn-new">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Divider -->
            <div class="search-divider-new">or</div>

            <!-- Keyword Search -->
            <div class="search-container-new">
                <form action="{{ route('search') }}" class="search-form-new" id="keywordSearchForm">
                    <div class="search-input-group keyword-group">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="form-control" name="keywords" placeholder="Search doctors, clinics, specialities...">
                    </div>

                    <button type="submit" class="btn search-btn-new">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Quick Search Tags -->
            <div class="quick-search-tags">
                <span class="tags-label">You may be looking for</span>
                <div class="tags-container">
                    @foreach($searchSpecialities->take(7) as $speciality)
                        <a href="{{ route('search', ['speciality_id' => $speciality->id]) }}" class="quick-tag">
                            {{ $speciality->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
<!-- /Home Banner -->

<!-- Clinic and Specialities -->
<section class="section section-specialities">
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
                                <img src="{{ asset('storage/'.$speciality->image) }}" class="img-fluid" alt="Speciality">
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
</section>
<!-- Clinic and Specialities -->

<!-- Medical Products -->
<section class="section section-products" style="background-color: #fff;">
    <div class="container">
        <div class="section-header text-center">
            <h2>Featured Medical Products</h2>
            <p class="sub-title">Order medicines and health products from our trusted pharmacy store.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="product-slider slider">
                    @foreach($products as $product)
                    <div class="product-item">
                        <div class="product-card">
                            <div class="product-img">
                                <a href="#">
                                    @php
                                        $image = $product->image;
                                        if(!$image && !empty($product->gallery) && is_array($product->gallery)) {
                                            $image = $product->gallery[0] ?? null;
                                        }
                                    @endphp
                                    <img src="{{ $image ? asset('storage/'.$image) : asset('assets/img/products/product.jpg') }}" class="img-fluid" alt="{{ $product->name }}">
                                </a>
                                @if($product->discount_percentage > 0)
                                <span class="badge badge-danger product-badge">-{{ $product->discount_percentage }}% Off</span>
                                @elseif($product->is_featured)
                                <span class="badge badge-success product-badge">Featured</span>
                                @endif
                                <div class="product-actions">
                                    <a href="#" class="btn-action" title="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="#" class="btn-action" title="View Details"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <span class="category-name">{{ $product->category->name ?? 'Medicine' }}</span>
                                <h4><a href="#">{{ $product->name }}</a></h4>
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <span class="d-inline-block average-rating">(5.0)</span>
                                </div>
                                <div class="price-box">
                                    @if($product->sale_price)
                                        <span class="price">৳{{ number_format($product->sale_price, 0) }}</span>
                                        <span class="strike">৳{{ number_format($product->price, 0) }}</span>
                                    @else
                                        <span class="price">৳{{ number_format($product->price, 0) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="view-all text-center mt-4">
                    <a href="#" class="btn btn-primary">View All Products</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Medical Products -->

<!-- Popular Doctors -->
<section class="section section-doctor">
    <div class="container">
        <div class="section-header text-center">
            <h2>Book Our Doctors</h2>
            <p class="sub-title">Meet our expert doctors and book your appointment today</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="doctor-slider slider">
                    @foreach($doctors as $doctor)
                    <div class="doctor-profile-widget">
                        <div class="doc-pro-img">
                            <a href="{{ route('doctor.profile', $doctor->id) }}">
                                <div class="doctor-profile-img">
                                    <img src="{{ $doctor->profile_image ? asset('storage/'.$doctor->profile_image) : asset('assets/img/doctors/doctor-thumb-01.jpg') }}" class="img-fluid" alt="User Image">
                                </div>
                            </a>
                            <div class="doctor-amount">
                                <span>৳ {{ $doctor->pricing === 'free' ? 'Free' : ($doctor->pricing === 'custom_price' ? number_format($doctor->custom_price, 0) : '0') }}</span>
                            </div>
                        </div>
                        <div class="doc-pro-info">
                            <div class="doc-speciality">
                                <span class="badge badge-soft-blue">{{ $doctor->speciality->name ?? 'General' }}</span>
                            </div>
                            <h4 class="doc-name">
                                <a href="{{ route('doctor.profile', $doctor->id) }}">Dr. {{ $doctor->user->name }}</a>
                                <i class="fas fa-check-circle verified-icon ml-1" title="Verified"></i>
                            </h4>
                            <div class="doc-rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <span class="rating-count">(5.0)</span>
                            </div>

                            <div class="doc-location">
                                <p><i class="fas fa-map-marker-alt"></i> {{ $doctor->clinic_name ?? ($doctor->clinic_city ?? 'Dhaka, Bangladesh') }}</p>
                            </div>

                            <div class="doc-pro-footer">
                                <a href="{{ route('booking', $doctor->id) }}" class="btn btn-primary btn-block">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Popular Doctors -->

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
                        <li><i class="fas fa-check-circle text-primary mr-2"></i> Leading Healthcare Provider</li>
                        <li><i class="fas fa-check-circle text-primary mr-2"></i> 24/7 Support Available</li>
                        <li><i class="fas fa-check-circle text-primary mr-2"></i> Experienced Doctors</li>
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
                            <span style="font-size: 50px; color: #0066ff;"><i class="fas fa-search"></i></span>
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
                            <span style="font-size: 50px; color: #0066ff;"><i class="fas fa-user-check"></i></span>
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
                            <span style="font-size: 50px; color: #0066ff;"><i class="fas fa-calendar-check"></i></span>
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
                            <span style="font-size: 50px; color: #0066ff;"><i class="fas fa-notes-medical"></i></span>
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
<section class="section section-stats" style="background: linear-gradient(135deg, #0066ff 0%, #00c6ff 100%); padding: 60px 0;">
    <div class="container">
        <div class="row text-center text-white">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="counter-box">
                    <h2 class="display-4 font-weight-bold mb-2"><i class="fas fa-user-md mr-2"></i>500+</h2>
                    <p class="mb-0" style="font-size: 18px;">Expert Doctors</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="counter-box">
                    <h2 class="display-4 font-weight-bold mb-2"><i class="fas fa-users mr-2"></i>10K+</h2>
                    <p class="mb-0" style="font-size: 18px;">Happy Patients</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="counter-box">
                    <h2 class="display-4 font-weight-bold mb-2"><i class="fas fa-hospital mr-2"></i>100+</h2>
                    <p class="mb-0" style="font-size: 18px;">Clinics & Hospitals</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-box">
                    <h2 class="display-4 font-weight-bold mb-2"><i class="fas fa-award mr-2"></i>15+</h2>
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
                            <img src="{{ asset('assets/img/patients/patient1.jpg') }}" class="rounded-circle mr-3" alt="Patient" style="width: 50px; height: 50px; object-fit: cover;">
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
                            <img src="{{ asset('assets/img/patients/patient2.jpg') }}" class="rounded-circle mr-3" alt="Patient" style="width: 50px; height: 50px; object-fit: cover;">
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
                            <img src="{{ asset('assets/img/patients/patient3.jpg') }}" class="rounded-circle mr-3" alt="Patient" style="width: 50px; height: 50px; object-fit: cover;">
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
            <i class="fas fa-calendar-check mr-2"></i> Find a Doctor Now
        </a>
    </div>
</section>
<!-- /Call to Action -->
<!-- /Call to Action -->

@endsection

@push('scripts')
<script>
$(document).ready(function() {
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
});
</script>
@endpush


