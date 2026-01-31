@extends('layouts.app')

@section('title', 'Search Doctors - Doccure')

@push('styles')
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

<!-- Fancybox CSS -->
<link rel="stylesheet" href="{{ asset('assets/plugins/fancybox/jquery.fancybox.min.css') }}">

<style>
/* =====================================
   PREMIUM SEARCH FILTER STYLES
===================================== */

.search-filter-premium {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.search-filter-premium .filter-header {
    background: #f8fafc;
    color: #1f2937;
    padding: 14px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #e5e7eb;
}

.search-filter-premium .filter-header h4 {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #374151;
}

.search-filter-premium .filter-header h4 i {
    color: #6b7280;
    font-size: 14px;
}

.search-filter-premium .filter-header .reset-btn {
    background: transparent;
    color: #2563eb;
    border: none;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 400;
    cursor: pointer;
    transition: all 0.2s ease;
}

.search-filter-premium .filter-header .reset-btn:hover {
    background: #eff6ff;
}

.filter-body {
    padding: 0;
}

/* Filter Section */
.filter-section {
    border-bottom: 1px solid #f0f0f0;
}

.filter-section:last-child {
    border-bottom: none;
}

.filter-section-header {
    padding: 12px 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.2s ease;
}

.filter-section-header:hover {
    background: #f9fafb;
}

.filter-section-header h5 {
    margin: 0;
    font-size: 13px;
    font-weight: 500;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-section-header h5 i {
    color: #9ca3af;
    font-size: 13px;
    width: 16px;
}

.filter-section-header .toggle-icon {
    color: #9ca3af;
    transition: transform 0.3s ease;
}

.filter-section.collapsed .toggle-icon {
    transform: rotate(-90deg);
}

.filter-section-content {
    padding: 0 16px 12px 16px;
}

.filter-section.collapsed .filter-section-content {
    display: none;
}

/* Custom Checkbox */
/* Custom Checkbox */
.custom-filter-check {
    display: flex;
    align-items: center;
    padding: 6px 10px;
    margin: 2px 0;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.custom-filter-check:hover {
    background: #f8fafc;
}

.custom-filter-check input[type="checkbox"] {
    display: none;
}

.custom-filter-check .check-box {
    width: 16px;
    height: 16px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    margin-right: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    background: white;
}

.custom-filter-check input:checked + .check-box {
    background: #2563eb;
    border-color: #2563eb;
}

.custom-filter-check input:checked + .check-box::after {
    content: '\f00c';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    color: white;
    font-size: 9px;
}

.custom-filter-check .check-label {
    font-size: 13px;
    color: #4b5563;
    flex: 1;
}

.custom-filter-check .check-count {
    background: #f3f4f6;
    color: #6b7280;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 11px;
}

/* Custom Select Dropdown */
/* Custom Select Dropdown */
.custom-filter-select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 13px;
    color: #374151;
    background: #fff;
    cursor: pointer;
    transition: all 0.2s ease;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 12px;
}

.custom-filter-select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
}

/* Fee Range Slider */
.fee-range-container {
    padding: 8px 0;
}

.fee-range-inputs {
    display: flex;
    gap: 8px;
    align-items: center;
    justify-content: space-between;
}

.fee-range-inputs .input-group {
    position: relative;
    flex: 1;
    min-width: 0; /* Prevents flex item from overflowing */
}

.fee-range-inputs input {
    width: 100%;
    padding: 8px 10px 8px 24px; /* Space for currency symbol */
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 13px;
    text-align: left;
    transition: all 0.2s;
    background: #fff;
    color: #374151;
}

.fee-range-inputs .currency-symbol {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 13px;
    pointer-events: none;
}

.fee-range-inputs input::placeholder {
    color: #9ca3af;
}

.fee-range-inputs input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.05);
}

.fee-range-inputs .separator {
    color: #9ca3af;
    font-size: 13px;
    font-weight: 500;
}

/* Rating Stars */
/* Rating Stars */
.rating-filter {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.rating-option {
    display: flex;
    align-items: center;
    padding: 8px 10px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.rating-option:hover {
    background: #f8fafc;
}

.rating-option input[type="radio"] {
    display: none;
}

.rating-option .stars {
    display: flex;
    gap: 2px;
    margin-right: 8px;
}

.rating-option .stars i {
    color: #fbbf24;
    font-size: 13px;
}

.rating-option .stars i.empty {
    color: #e5e7eb;
}

.rating-option input:checked ~ .stars i:not(.empty) {
    color: #f59e0b;
}

.rating-option.selected {
    background: #fffbeb;
}

.rating-option span {
    font-size: 13px;
    color: #6b7280;
}

/* Toggle Switch */
/* Toggle Switch */
.toggle-filter {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 12px;
    background: #f8fafc;
    border-radius: 8px;
    margin: 6px 0;
    border: 1px solid #f3f4f6;
}

.toggle-filter .toggle-label {
    font-size: 13px;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 8px;
}

.toggle-filter .toggle-label i {
    color: #6b7280;
    font-size: 13px;
}

.toggle-switch {
    position: relative;
    width: 36px;
    height: 20px;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #d1d5db;
    transition: .3s;
    border-radius: 20px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    transition: .3s;
    border-radius: 50%;
}

.toggle-switch input:checked + .toggle-slider {
    background-color: #2563eb;
}

.toggle-switch input:checked + .toggle-slider:before {
    transform: translateX(16px);
}

/* Search Button */
/* Search Button */
.filter-search-btn {
    margin: 16px;
    margin-top: 0;
}

.filter-search-btn button {
    width: 100%;
    padding: 10px;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.filter-search-btn button:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2);
}

/* Active Filters Tags */
.active-filters {
    padding: 12px 16px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
}

.active-filters-title {
    font-size: 11px;
    color: #6b7280;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.filter-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.filter-tag {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 8px;
    background: #e0e7ff;
    color: #3730a3;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
}

.filter-tag .remove-tag {
    cursor: pointer;
    opacity: 0.6;
    font-size: 10px;
}

.filter-tag .remove-tag:hover {
    opacity: 1;
}

/* Sort Bar */
/* Sort Bar */
.sort-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    border: 1px solid #e5e7eb;
}

.sort-bar .results-count {
    font-size: 13px;
    color: #6b7280;
}

.sort-bar .results-count strong {
    color: #1f2937;
    font-weight: 600;
}

.sort-bar .sort-options {
    display: flex;
    align-items: center;
    gap: 8px;
}

.sort-bar .sort-options label {
    font-size: 13px;
    color: #6b7280;
}

.sort-bar .sort-select {
    padding: 6px 28px 6px 10px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 13px;
    background: white;
    cursor: pointer;
    color: #374151;
}

.sort-bar .sort-select:focus {
    outline: none;
    border-color: #3b82f6;
}

/* Pagination Custom */
.pagination {
    justify-content: center;
    gap: 6px;
    margin-top: 20px;
}

.page-item .page-link {
    border: none;
    border-radius: 8px;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4b5563;
    font-weight: 500;
    font-size: 14px;
    background: white;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    transition: all 0.2s;
}

.page-item .page-link:hover {
    background: #f3f4f6;
    color: #1f2937;
    transform: translateY(-1px);
}

.page-item.active .page-link {
    background: #2563eb;
    color: white;
    box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
}

.page-item.disabled .page-link {
    background: #f9fafb;
    color: #d1d5db;
    cursor: not-allowed;
    box-shadow: none;
}

/* Responsive */
@media (max-width: 991px) {
    .search-filter-premium {
        margin-bottom: 20px;
    }
}
</style>
@endpush

@section('content')

<!-- Page Content -->
<div class="content" style="padding-top: 100px; background: #f8fafc; min-height: 100vh;">
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

                <!-- Premium Search Filter -->
                <form id="searchFilterForm" method="GET" action="{{ route('search') }}">
                <div class="search-filter-premium">
                    <!-- Header -->
                    <div class="filter-header">
                        <h4><i class="fas fa-filter"></i> Search Filter</h4>
                        <button type="button" class="reset-btn" onclick="resetFilters()">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>

                    <!-- Filter Body -->
                    <div class="filter-body">

                        <!-- Location Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5><i class="fas fa-map-marker-alt"></i> Location</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <select name="district_id" class="custom-filter-select" id="filterDistrict">
                                    <option value="">All Districts</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div style="margin-top: 12px;">
                                    <select name="area_id" class="custom-filter-select" id="filterArea" {{ !request('district_id') ? 'disabled' : '' }}>
                                        <option value="">Select District First</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Speciality Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5><i class="fas fa-stethoscope"></i> Speciality</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content" style="max-height: 200px; overflow-y: auto;">
                                @foreach($specialities as $speciality)
                                <label class="custom-filter-check">
                                    <input type="checkbox" name="select_specialist[]" value="{{ $speciality->id }}"
                                        {{ in_array($speciality->id, (array)request('select_specialist')) ? 'checked' : '' }}>
                                    <span class="check-box"></span>
                                    <span class="check-label">{{ $speciality->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Gender Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5><i class="fas fa-venus-mars"></i> Gender</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <label class="custom-filter-check">
                                    <input type="checkbox" name="gender[]" value="male"
                                        {{ in_array('male', (array)request('gender')) ? 'checked' : '' }}>
                                    <span class="check-box"></span>
                                    <span class="check-label">Male Doctor</span>
                                </label>
                                <label class="custom-filter-check">
                                    <input type="checkbox" name="gender[]" value="female"
                                        {{ in_array('female', (array)request('gender')) ? 'checked' : '' }}>
                                    <span class="check-box"></span>
                                    <span class="check-label">Female Doctor</span>
                                </label>
                            </div>
                        </div>

                        <!-- Fee Range Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5><i class="fas fa-money-bill-wave"></i> Consultation Fee</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <div class="fee-range-container">
                                    <div class="fee-range-inputs">
                                        <div class="input-group">
                                            <span class="currency-symbol">৳</span>
                                            <input type="number" name="fee_min" placeholder="Min" value="{{ request('fee_min') }}">
                                        </div>
                                        <span class="separator">-</span>
                                        <div class="input-group">
                                            <span class="currency-symbol">৳</span>
                                            <input type="number" name="fee_max" placeholder="Max" value="{{ request('fee_max') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Experience Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5><i class="fas fa-briefcase-medical"></i> Experience</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <select name="experience" class="custom-filter-select">
                                    <option value="">Any Experience</option>
                                    <option value="1" {{ request('experience') == '1' ? 'selected' : '' }}>1+ Years</option>
                                    <option value="5" {{ request('experience') == '5' ? 'selected' : '' }}>5+ Years</option>
                                    <option value="10" {{ request('experience') == '10' ? 'selected' : '' }}>10+ Years</option>
                                    <option value="15" {{ request('experience') == '15' ? 'selected' : '' }}>15+ Years</option>
                                    <option value="20" {{ request('experience') == '20' ? 'selected' : '' }}>20+ Years</option>
                                </select>
                            </div>
                        </div>

                        <!-- Rating Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5><i class="fas fa-star"></i> Rating</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <div class="rating-filter">
                                    <label class="rating-option {{ request('rating') == '4' ? 'selected' : '' }}">
                                        <input type="radio" name="rating" value="4" {{ request('rating') == '4' ? 'checked' : '' }}>
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star empty"></i>
                                        </div>
                                        <span>4+ Stars</span>
                                    </label>
                                    <label class="rating-option {{ request('rating') == '3' ? 'selected' : '' }}">
                                        <input type="radio" name="rating" value="3" {{ request('rating') == '3' ? 'checked' : '' }}>
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star empty"></i>
                                            <i class="fas fa-star empty"></i>
                                        </div>
                                        <span>3+ Stars</span>
                                    </label>
                                    <label class="rating-option {{ request('rating') == '' ? 'selected' : '' }}">
                                        <input type="radio" name="rating" value="" {{ !request('rating') ? 'checked' : '' }}>
                                        <div class="stars">
                                            <i class="fas fa-star empty"></i>
                                            <i class="fas fa-star empty"></i>
                                            <i class="fas fa-star empty"></i>
                                            <i class="fas fa-star empty"></i>
                                            <i class="fas fa-star empty"></i>
                                        </div>
                                        <span>All Ratings</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Services Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5><i class="fas fa-concierge-bell"></i> Services</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <div class="toggle-filter">
                                    <span class="toggle-label">
                                        <i class="fas fa-video"></i> Online Consultation
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="online_consultation" value="1"
                                            {{ request('online_consultation') == '1' ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                                <div class="toggle-filter">
                                    <span class="toggle-label">
                                        <i class="fas fa-home"></i> Home Visit
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="home_visit" value="1"
                                            {{ request('home_visit') == '1' ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                                <div class="toggle-filter">
                                    <span class="toggle-label">
                                        <i class="fas fa-check-circle"></i> Verified Only
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="verified_only" value="1"
                                            {{ request('verified_only') == '1' ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Search Button -->
                    <div class="filter-search-btn">
                        <button type="submit">
                            <i class="fas fa-search"></i> Apply Filters
                        </button>
                    </div>
                </div>
                </form>
                <!-- /Premium Search Filter -->

            </div>

            <div class="col-md-12 col-lg-8 col-xl-9">

                <div id="doctor-list-container">
                    @include('frontend.super-doctor-list')
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

<!-- Datetimepicker JS -->
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Fancybox JS -->
<script src="{{ asset('assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

<script>
    // Toggle filter section
    function toggleSection(header) {
        var section = header.closest('.filter-section');
        section.classList.toggle('collapsed');
    }

    // Reset all filters
    function resetFilters() {
        window.location.href = '{{ route("search") }}';
    }

    // Change sort (AJAX)
    function changeSortBy(value) {
        // Update URL param without reload
        var url = new URL(window.location.href);
        url.searchParams.set('sort_by', value);
        window.history.pushState({}, '', url);
        
        submitFilterForm();
    }

    // Auto-submit form function (AJAX)
    function submitFilterForm() {
        var $form = $('#searchFilterForm');
        var formData = $form.serialize();
        var sortBy = new URL(window.location.href).searchParams.get('sort_by') || 'relevance';
        
        // Add sort_by to formData
        if (formData) {
            formData += '&sort_by=' + sortBy;
        } else {
            formData = 'sort_by=' + sortBy;
        }

        // Show loading state (optional: add overlay or spinner)
        $('#doctor-list-container').css('opacity', '0.5');

        $.ajax({
            url: '{{ route("search") }}',
            type: 'GET',
            data: formData,
            success: function(response) {
                $('#doctor-list-container').html(response).css('opacity', '1');
                
                // Update URL without reload
                var newUrl = new URL(window.location.href);
                // We should update all params from form but for now just pushState is enough visually
                // A better way is construct URL from formData but let's keep it simple
            },
            error: function() {
                alert('Something went wrong. Please try again.');
                $('#doctor-list-container').css('opacity', '1');
            }
        });
    }

    // Debounce function for inputs
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // District change - load areas AND submit
    $('#filterDistrict').on('change', function() {
        var districtId = $(this).val();
        var $areaSelect = $('#filterArea');

        // Allow interacting with form without reload
        submitFilterForm();
        
        if (districtId) {
            $areaSelect.prop('disabled', false);
            // Don't clear content immediately, looks bad. Just load.
            
            $.ajax({
                url: '/api/areas/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function(areas) {
                    var html = '<option value="">All Areas</option>';
                    $.each(areas, function(key, area) {
                        html += '<option value="' + area.id + '">' + area.name + '</option>';
                    });
                    $areaSelect.html(html);
                }
            });
        } else {
            $areaSelect.prop('disabled', true);
            $areaSelect.html('<option value="">Select District First</option>');
        }
    });

    // Other inputs change - Auto Submit
    $('#filterArea, input[name="select_specialist[]"], input[name="gender[]"], input[name="experience"], input[name="rating"], input[name="online_consultation"], input[name="home_visit"], input[name="verified_only"]').on('change', function() {
        submitFilterForm();
    });
    
    // Select dropdowns specifically (if not covered above)
    $('select[name="experience"]').on('change', function() {
        submitFilterForm();
    });
    
    // Prevent form actual submit
    $('#searchFilterForm').on('submit', function(e) {
        e.preventDefault();
        submitFilterForm();
    });

    // Fee inputs - Debounce submit (wait 1 sec after typing stops)
    const debouncedSubmit = debounce(() => submitFilterForm(), 1000);
    $('input[name="fee_min"], input[name="fee_max"]').on('input', debouncedSubmit);

    // Rating option click
    $('.rating-option').on('click', function() {
        $('.rating-option').removeClass('selected');
        $(this).addClass('selected');
        // Specific handling for radio button trigger
        var radio = $(this).find('input[type="radio"]');
        radio.prop('checked', true).trigger('change');
    });

    // AJAX Pagination
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        $('#doctor-list-container').css('opacity', '0.5');
        $('html, body').animate({
            scrollTop: $(".sort-bar").offset().top - 100
        }, 500);

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#doctor-list-container').html(response).css('opacity', '1');
                window.history.pushState({}, '', url);
            },
            error: function() {
                alert('Something went wrong. Please try again.');
                $('#doctor-list-container').css('opacity', '1');
            }
        });
    });

    // Initialize sticky sidebar
    $(document).ready(function() {
        if ($(window).width() > 991) {
            $('.theiaStickySidebar').theiaStickySidebar({
                additionalMarginTop: 100
            });
        }
        
        // Hide submit button since we have auto-submit and AJAX
        $('.filter-search-btn').hide();

        // Load areas if district is selected (for initial page load)
        var selectedDistrict = '{{ request("district_id") }}';
        var selectedArea = '{{ request("area_id") }}';
        if (selectedDistrict) {
            $.ajax({
                url: '/api/areas/' + selectedDistrict,
                type: 'GET',
                dataType: 'json',
                success: function(areas) {
                    var html = '<option value="">All Areas</option>';
                    $.each(areas, function(key, area) {
                        var isSelected = area.id == selectedArea ? 'selected' : '';
                        html += '<option value="' + area.id + '" ' + isSelected + '>' + area.name + '</option>';
                    });
                    $('#filterArea').html(html).prop('disabled', false);
                    
                    // Re-attach event listener for new elements
                    $('#filterArea').off('change').on('change', function() {
                        submitFilterForm();
                    });
                }
            });
        }
    });
</script>
@endpush
