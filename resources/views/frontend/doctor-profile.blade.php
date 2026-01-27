@extends('layouts.app')

@section('title', 'Doctor Profile - Doccure')

@section('content')

<!-- Page Content -->
<div class="content">
    <div class="container">

        <!-- Doctor Widget -->
        <div class="card">
            <div class="card-body">
                <div class="doctor-widget">
                    <div class="doc-info-left">
                        <div class="doctor-img">
                            <img src="{{ $doctor->profile_image ? asset('storage/'.$doctor->profile_image) : asset('assets/img/doctors/doctor-thumb-02.jpg') }}" class="img-fluid" alt="User Image">
                        </div>
                        <div class="doc-info-cont">
                            <h4 class="doc-name">Dr. {{ $doctor->user->name }}</h4>
                            <p class="doc-speciality">{{ $doctor->qualifications }}</p>
                            <p class="doc-department">
                                @if($doctor->speciality && $doctor->speciality->image)
                                <img src="{{ asset('storage/'.$doctor->speciality->image) }}" class="img-fluid" alt="Speciality">
                                @endif
                                {{ $doctor->speciality->name ?? 'General' }}
                            </p>
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $doctor->average_rating ? 'filled' : '' }}"></i>
                                @endfor
                                <span class="d-inline-block average-rating">({{ $doctor->review_count }})</span>
                            </div>
                            <div class="clinic-details">
                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{ $doctor->clinic_city }}, {{ $doctor->clinic_address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="doc-info-right">
                        <div class="clini-infos">
                            <ul>
                                <li><i class="far fa-thumbs-up"></i> 100%</li>
                                <li><i class="far fa-comment"></i> {{ $doctor->review_count }} Feedback</li>
                                <li><i class="fas fa-map-marker-alt"></i> {{ $doctor->clinic_city }}</li>
                                <li><i class="far fa-money-bill-alt"></i> {{ $doctor->pricing === 'free' ? 'Free' : ($doctor->pricing === 'custom_price' ? '$'.$doctor->custom_price : 'N/A') }} </li>
                            </ul>
                        </div>
                        <div class="doctor-action">
                            <a href="javascript:void(0)" class="btn btn-white fav-btn">
                                <i class="far fa-bookmark"></i>
                            </a>
                            <a href="{{ route('chat') }}" class="btn btn-white msg-btn">
                                <i class="far fa-comment-alt"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-white call-btn" data-bs-toggle="modal" data-bs-target="#voice_call">
                                <i class="fas fa-phone"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-white call-btn" data-bs-toggle="modal" data-bs-target="#video_call">
                                <i class="fas fa-video"></i>
                            </a>
                        </div>
                        <div class="clinic-booking">
                            <a class="apt-btn" href="{{ route('booking', $doctor->id) }}">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Doctor Widget -->

        <!-- Doctor Details Tab -->
        <div class="card">
            <div class="card-body pt-0">

                <!-- Tab Menu -->
                <nav class="user-tabs mb-4">
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" href="#doc_overview" data-bs-toggle="tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_locations" data-bs-toggle="tab">Locations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_reviews" data-bs-toggle="tab">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_business_hours" data-bs-toggle="tab">Business Hours</a>
                        </li>
                    </ul>
                </nav>
                <!-- /Tab Menu -->

                <!-- Tab Content -->
                <div class="tab-content pt-0">

                    <!-- Overview Content -->
                    <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-md-12 col-lg-9">

                                <!-- About Details -->
                                <div class="widget about-widget">
                                    <h4 class="widget-title">About Me</h4>
                                    <p>{{ $doctor->bio }}</p>
                                </div>
                                <!-- /About Details -->

                            </div>
                        </div>
                    </div>
                    <!-- /Overview Content -->

                    <!-- Locations Content -->
                    <div role="tabpanel" id="doc_locations" class="tab-pane fade">

                        <!-- Location List -->
                        <div class="location-list">
                            <div class="row">
                                <!-- Clinic Content -->
                                <div class="col-md-6">
                                    <div class="clinic-content">
                                        <h4 class="clinic-name"><a href="#">{{ $doctor->clinic_name ?? 'Clone Clinic' }}</a></h4>
                                        <p class="doc-speciality">{{ $doctor->qualifications }}</p>
                                        <div class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $doctor->average_rating ? 'filled' : '' }}"></i>
                                            @endfor
                                            <span class="d-inline-block average-rating">({{ $doctor->review_count }})</span>
                                        </div>
                                        <div class="clinic-details mb-0">
                                            <h5 class="clinic-direction"> <i class="fas fa-map-marker-alt"></i> {{ $doctor->clinic_address }}, {{ $doctor->clinic_city }} <br><a href="javascript:void(0);">Get Directions</a></h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Clinic Content -->

                                <!-- Clinic Timing -->
                                <div class="col-md-4">
                                    <div class="clinic-timing">
                                        @forelse($doctor->schedules as $schedule)
                                        <div>
                                            <p class="timings-days">{{ ucfirst($schedule->day) }}</p>
                                            <p class="timings-times">{{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</p>
                                        </div>
                                        @empty
                                        <div><p>No schedules available</p></div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- /Clinic Timing -->

                                <div class="col-md-2">
                                    <div class="consult-price">
                                        {{ $doctor->pricing === 'free' ? 'Free' : ($doctor->pricing === 'custom_price' ? '$'.$doctor->custom_price : 'N/A') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Location List -->

                    </div>
                    <!-- /Locations Content -->

                    <!-- Reviews Content -->
                    <div role="tabpanel" id="doc_reviews" class="tab-pane fade">
                        <!-- Review Listing -->
                        <div class="widget review-listing">
                            <ul class="comments-list">
                                <!-- Comment List -->
                                @forelse($doctor->reviews as $review)
                                <li>
                                    <div class="comment">
                                        <img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{ optional($review->patient->user)->profile_image ? asset('storage/'.$review->patient->user->profile_image) : asset('assets/img/patients/patient.jpg') }}">
                                        <div class="comment-body">
                                            <div class="meta-data">
                                                <span class="comment-author">{{ $review->patient->user->name ?? 'Patient' }}</span>
                                                <span class="comment-date">{{ $review->created_at->diffForHumans() }}</span>
                                                <div class="review-count rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $review->rating ? 'filled' : '' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="comment-content">
                                                {{ $review->comment }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li><p>No reviews yet.</p></li>
                                @endforelse
                                <!-- /Comment List -->
                            </ul>
                        </div>
                        <!-- /Review Listing -->

                        <!-- Write Review -->
                        <div class="write-review">
                            <h4>Write a review for <strong>Dr. Darren Elder</strong></h4>

                            <!-- Write Review Form -->
                            <form>
                                <div class="mb-3">
                                    <label>Review</label>
                                    <div class="star-rating">
                                        <input id="star-5" type="radio" name="rating" value="5">
                                        <label for="star-5" title="5 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-4" type="radio" name="rating" value="4">
                                        <label for="star-4" title="4 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-3" type="radio" name="rating" value="3">
                                        <label for="star-3" title="3 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-2" type="radio" name="rating" value="2">
                                        <label for="star-2" title="2 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-1" type="radio" name="rating" value="1">
                                        <label for="star-1" title="1 star">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Title of your review</label>
                                    <input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?">
                                </div>
                                <div class="mb-3">
                                    <label>Your review</label>
                                    <textarea id="review_desc" maxlength="100" class="form-control"></textarea>

                                    <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <div class="terms-accept">
                                        <div class="custom-checkbox">
                                           <input type="checkbox" id="terms_accept">
                                           <label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                                </div>
                            </form>
                            <!-- /Write Review Form -->

                        </div>
                        <!-- /Write Review -->

                    </div>
                    <!-- /Reviews Content -->

                    <!-- Business Hours Content -->
                    <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">

                                <!-- Business Hours Widget -->
                                <div class="widget business-widget">
                                    <div class="widget-content">
                                        <div class="listing-hours">
                                            @forelse($doctor->schedules as $schedule)
                                            <div class="listing-day">
                                                <div class="day">{{ ucfirst($schedule->day) }}</div>
                                                <div class="time-items">
                                                    <span class="time">{{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</span>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="listing-day">
                                                <div class="day">No schedules available</div>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <!-- /Business Hours Widget -->

                            </div>
                        </div>
                    </div>
                    <!-- /Business Hours Content -->

                </div>
            </div>
        </div>
        <!-- /Doctor Details Tab -->

    </div>
</div>
<!-- /Page Content -->
@endsection
