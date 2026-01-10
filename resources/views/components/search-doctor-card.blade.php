<!-- Doctor Widget for Search Page -->
<div class="card">
    <div class="card-body">
        <div class="doctor-widget">
            <div class="doc-info-left">
                <div class="doctor-img">
                    <a href="{{ $profileLink }}">
                        <img src="{{ $image }}" class="img-fluid" alt="User Image">
                    </a>
                </div>
                <div class="doc-info-cont">
                    <h4 class="doc-name"><a href="{{ $profileLink }}">{{ $name }}</a></h4>
                    <p class="doc-speciality">{{ $speciality }}</p>
                    <h5 class="doc-department"><img src="{{ $departmentIcon }}" class="img-fluid" alt="Speciality">{{ $department }}</h5>
                    <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $rating ? 'filled' : '' }}"></i>
                        @endfor
                        <span class="d-inline-block average-rating">({{ $reviews }})</span>
                    </div>
                    <div class="clinic-details">
                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{ $location }}</p>
                        <ul class="clinic-gallery">
                            <li>
                                <a href="{{ asset('assets/img/features/feature-01.jpg') }}" data-fancybox="gallery">
                                    <img src="{{ asset('assets/img/features/feature-01.jpg') }}" alt="Feature">
                                </a>
                            </li>
                            <li>
                                <a href="{{ asset('assets/img/features/feature-02.jpg') }}" data-fancybox="gallery">
                                    <img  src="{{ asset('assets/img/features/feature-02.jpg') }}" alt="Feature">
                                </a>
                            </li>
                            <li>
                                <a href="{{ asset('assets/img/features/feature-03.jpg') }}" data-fancybox="gallery">
                                    <img src="{{ asset('assets/img/features/feature-03.jpg') }}" alt="Feature">
                                </a>
                            </li>
                            <li>
                                <a href="{{ asset('assets/img/features/feature-04.jpg') }}" data-fancybox="gallery">
                                    <img src="{{ asset('assets/img/features/feature-04.jpg') }}" alt="Feature">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clinic-services">
                        <span>Dental Fillings</span>
                        <span> Whitneing</span>
                    </div>
                </div>
            </div>
            <div class="doc-info-right">
                <div class="clini-infos">
                    <ul>
                        <li><i class="far fa-thumbs-up"></i> {{ $thumbsUp }}</li>
                        <li><i class="far fa-comment"></i> {{ $reviews }} Feedback</li>
                        <li><i class="fas fa-map-marker-alt"></i> {{ $location }}</li>
                        <li><i class="far fa-money-bill-alt"></i> {{ $price }} <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i> </li>
                    </ul>
                </div>
                <div class="clinic-booking">
                    <a class="view-pro-btn" href="{{ $profileLink }}">View Profile</a>
                    <a class="apt-btn" href="{{ $bookingLink }}">Book Appointment</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Doctor Widget -->
