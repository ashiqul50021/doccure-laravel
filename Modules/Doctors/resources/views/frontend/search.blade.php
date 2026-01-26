@extends('layouts.app')

@section('title', 'Search Doctors - Doccure')

@push('styles')
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

<!-- Select2 CSS -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

<!-- Fancybox CSS -->
<link rel="stylesheet" href="{{ asset('assets/plugins/fancybox/jquery.fancybox.min.css') }}">
@endpush

@section('content')

<!-- Page Content -->
<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

                <!-- Search Filter -->
                <div class="card search-filter">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Search Filter</h4>
                    </div>
                    <div class="card-body">
                    <div class="filter-widget">
                        <div class="cal-icon">
                            <input type="text" class="form-control datetimepicker" placeholder="Select Date">
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4>Gender</h4>
                        <div>
                            <label class="custom_check">
                                <input type="checkbox" name="gender_type" checked>
                                <span class="checkmark"></span> Male Doctor
                            </label>
                        </div>
                        <div>
                            <label class="custom_check">
                                <input type="checkbox" name="gender_type">
                                <span class="checkmark"></span> Female Doctor
                            </label>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4>Select Specialist</h4>
                        @foreach($specialities as $speciality)
                        <div>
                            <label class="custom_check">
                                <input type="checkbox" name="select_specialist[]" value="{{ $speciality->id }}">
                                <span class="checkmark"></span> {{ $speciality->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                        <div class="btn-search">
                            <button type="button" class="btn btn-block">Search</button>
                        </div>
                    </div>
                </div>
                <!-- /Search Filter -->

            </div>

            <div class="col-md-12 col-lg-8 col-xl-9">

                @foreach($doctors as $doctor)
                    @include('components.search-doctor-card', [
                        'image' => $doctor->profile_image ? asset('storage/'.$doctor->profile_image) : asset('assets/img/doctors/doctor-thumb-01.jpg'),
                        'name' => 'Dr. ' . $doctor->user->name,
                        'speciality' => $doctor->speciality->name ?? 'General',
                        'department' => $doctor->speciality->name ?? 'General',
                        'departmentIcon' => ($doctor->speciality && $doctor->speciality->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($doctor->speciality->image)) ? asset('storage/'.$doctor->speciality->image) : asset('assets/img/specialities/specialities-05.png'),
                        'rating' => $doctor->average_rating,
                        'reviews' => $doctor->review_count,
                        'location' => $doctor->clinic_name ?? ($doctor->clinic_city ?? 'Location'),
                        'price' => '$' . ($doctor->pricing === 'free' ? 'Free' : ($doctor->pricing === 'custom_price' ? $doctor->custom_price : '0')),
                        'thumbsUp' => '99%',
                        'profileLink' => route('doctor.profile', $doctor->id),
                        'bookingLink' => route('booking', $doctor->id)
                    ])

                    @if(($loop->index + 1) % 3 == 0 && $advertisements->isNotEmpty())
                        @php $ad = $advertisements->random(); @endphp
                        <div class="card mb-3">
                            <div class="card-body p-0">
                                <a href="{{ $ad->link ?? '#' }}" target="_blank">
                                    <img src="{{ asset('storage/'.$ad->image) }}" class="img-fluid" alt="{{ $ad->title }}" style="width: 100%; max-height: 200px; object-fit: cover;">
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="load-more text-center">
                    {{ $doctors->withQueryString()->links() }}
                </div>


            </div>
        </div>

    </div>

</div>
<!-- /Page Content -->
@endsection

@push('scripts')
<!-- Sticky Sidebar JS -->
<script src="{{ asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
<script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

<!-- Select2 JS -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- Datetimepicker JS -->
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Fancybox JS -->
<script src="{{ asset('assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
@endpush
