<!-- Doctor Widget for Search Page - Premium Design -->
<div class="card doctor-search-card">
    <div class="card-body">
        <div class="doctor-widget">
            <!-- Doctor Image -->
            <div class="doc-info-left">
                <div class="doctor-img-wrap">
                    <a href="{{ $profileLink }}">
                        <img src="{{ $image }}" class="img-fluid doctor-profile-img" alt="{{ $name }}">
                    </a>
                    <span class="availability-badge">
                        <i class="fas fa-circle"></i> Available
                    </span>
                </div>

                <!-- Doctor Info -->
                <div class="doc-info-cont">
                    <h4 class="doc-name">
                        <a href="{{ $profileLink }}">{{ $name }}</a>
                        <i class="fas fa-check-circle verified-icon" title="Verified Doctor"></i>
                    </h4>

                    <p class="doc-speciality-text">{{ $speciality }}</p>

                    <div class="doc-department-pill">
                        <img src="{{ $departmentIcon }}" alt="{{ $department }}" onerror="this.onerror=null;this.src='{{ asset('assets/img/specialities/specialities-05.png') }}';">
                        <span>{{ $department }}</span>
                    </div>

                    <div class="doc-rating">
                        <div class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating ? 'filled' : '' }}"></i>
                            @endfor
                        </div>
                        <span class="rating-count">({{ $reviews }} reviews)</span>
                    </div>

                    <div class="doc-location-info">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $location }}</span>
                    </div>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="doc-info-right">
                <div class="doc-stats">
                    <div class="stat-item">
                        <i class="far fa-thumbs-up"></i>
                        <div class="stat-content">
                            <span class="stat-value">{{ $thumbsUp }}</span>
                            <span class="stat-label">Success</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="far fa-comment-alt"></i>
                        <div class="stat-content">
                            <span class="stat-value">{{ $reviews }}</span>
                            <span class="stat-label">Feedback</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="stat-content">
                            <span class="stat-value location-text">{{ $location }}</span>
                        </div>
                    </div>
                    <div class="stat-item price-stat">
                        <i class="fas fa-money-bill-wave"></i>
                        <div class="stat-content">
                            @if($price == '$Free' || $price == 'Free' || $price == '$0')
                                <span class="price-value free">Free</span>
                            @else
                                <span class="price-value">৳{{ str_replace(['$', 'Free'], '', $price) }}</span>
                            @endif
                            <span class="stat-label">Consultation</span>
                        </div>
                    </div>
                </div>

                <div class="doc-action-buttons">
                    <a class="btn-view-profile" href="{{ $profileLink }}">
                        <i class="fas fa-user"></i> View Profile
                    </a>
                    <a class="btn-book-now" href="{{ $bookingLink }}">
                        <i class="fas fa-calendar-check"></i> Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Doctor Widget -->
