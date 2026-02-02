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

/* =====================================
   V2 MINIMALIST LUXURY FILTER STYLES
===================================== */

.search-filter-premium {
    background: #ffffff;
    border-radius: 16px; /* Soft rounded corners */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); /* Reduced shadow spread */
    overflow: hidden;
    border: none; /* No border for clean look */
    margin-bottom: 30px;
}

/* Fix Rating Stars empty issue: ensure font-family is correct for filled */
.rating-option .stars i, .rating .fa-star {
    font-weight: 900; /* Font Awesome 'Solid' requires 900 weight */
}
.rating-option .stars i.empty, .rating .fa-star.empty {
    color: #e5e7eb;
}

.search-filter-premium .filter-header {
    background: #ffffff;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #f3f4f6;
}

.search-filter-premium .filter-header h4 {
    margin: 0;
    font-size: 16px; /* Slightly larger */
    font-weight: 700; /* Bold */
    color: #111827;
    letter-spacing: -0.01em;
    text-transform: uppercase; /* Modern touch */
}

/* Reset Button - Clean Link style */
.search-filter-premium .filter-header .reset-btn {
    background: transparent;
    color: #2563eb;
    border: none;
    padding: 0;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.search-filter-premium .filter-header .reset-btn:hover {
    color: #1d4ed8;
    text-decoration: underline;
}

.filter-body {
    padding: 24px; /* More breathing room */
}

/* Filter Section */
.filter-section {
    margin-bottom: 24px;
}

.filter-section:last-child {
    margin-bottom: 0;
}

.filter-section-header {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.filter-section-header h5 {
    margin: 0;
    font-size: 12px;
    font-weight: 700;
    color: #9ca3af; /* Muted label */
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Filled Inputs */
.custom-filter-select, 
.fee-range-inputs input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid transparent; /* No border initially */
    border-radius: 12px; /* Smooth corners */
    font-size: 14px;
    color: #1f2937;
    background: #f3f4f6; /* Filled style */
    transition: all 0.2s ease;
    font-weight: 500;
}

.custom-filter-select:focus,
.fee-range-inputs input:focus {
    outline: none;
    background: #ffffff;
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
}

/* Checkboxes as Interactive Rows */
.custom-filter-check {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    margin: 4px 0;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.15s ease;
    color: #4b5563;
}

.custom-filter-check input {
    display: none; /* FIX: Hide default checkbox */
}

.custom-filter-check:hover {
    background: #f9fafb;
    color: #111827;
}

.custom-filter-check input:checked + .check-box {
    background: #2563eb;
    border-color: #2563eb;
    transform: scale(1.1);
}

.custom-filter-check .check-box {
    width: 18px;
    height: 18px;
    border: 2px solid #d1d5db; /* Thicker border */
    border-radius: 6px; /* Soft square */
    margin-right: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
}

.custom-filter-check input:checked + .check-box::after {
    font-size: 10px;
}

.custom-filter-check .check-label {
    font-size: 14px;
    font-weight: 500;
}

/* Gender Pills V2 - Segmented Control Look */
.gender-pill {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px;
    background: #f3f4f6; /* Filled default */
    border: 1px solid transparent;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 14px;
    font-weight: 600;
    color: #6b7280;
}

.gender-pill input {
    display: none; /* FIX: Hide default checkbox in pills */
}

.gender-pill:hover {
    background: #e5e7eb;
}

.gender-pill.active {
    background: #2563eb; /* Brand Blue */
    color: white;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); /* Glow */
}

/* Search Button V2 */
.filter-search-btn button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    transition: all 0.3s ease;
}

.filter-search-btn button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
}


/* Toggle Switch (IOS Style) */
.toggle-filter {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px;
    background: #ffffff;
    border-radius: 12px;
    margin-bottom: 8px;
    border: 1px solid #f3f4f6;
    transition: all 0.2s ease;
}

.toggle-filter:hover {
    border-color: #e5e7eb;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}

.toggle-filter .toggle-label {
    font-size: 14px;
    color: #374151;
    font-weight: 500;
}

.toggle-switch {
    position: relative;
    width: 44px;
    height: 24px;
    flex-shrink: 0;
}

.toggle-switch input {
    display: none;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #e5e7eb;
    transition: .3s;
    border-radius: 24px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    transition: .3s;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.toggle-switch input:checked + .toggle-slider {
    background-color: #2563eb;
}

.toggle-switch input:checked + .toggle-slider:before {
    transform: translateX(20px);
}

/* Rating Stars V2 (Vertical List) */
.rating-filter {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.rating-option {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 1px solid transparent;
    background: #f9fafb;
}

.rating-option:hover {
    background: #f3f4f6;
    border-color: #e5e7eb;
}

.rating-option.selected {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    box-shadow: 0 2px 5px rgba(37, 99, 235, 0.05);
}

.rating-option input {
    display: none;
}

.rating-option .stars {
    display: flex;
    gap: 3px;
    margin-right: 12px;
}

.rating-option .stars i {
    font-size: 13px;
    color: #fbbf24;
}

.rating-option .stars i.empty {
    color: #d1d5db;
}

.rating-option span {
    font-size: 14px;
    color: #4b5563;
    font-weight: 500;
}

.rating-option.selected span {
    color: #1e40af;
    font-weight: 600;
}

/* Fee Range Fixes */
.fee-range-inputs .input-group {
    position: relative;
    display: block; /* Ensure correct block formatting context */
}
.fee-range-inputs .currency-symbol {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    color: #9ca3af;
    line-height: 1; /* Fix vertical alignment */
}
.fee-range-inputs input {
    padding-left: 28px;
    height: 44px; /* Explicit height for better vertical align */
}
/* Sort Bar */
.sort-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); /* Premium soft shadow */
    margin-bottom: 24px;
    border: 1px solid #f3f4f6;
}

.sort-bar .results-count {
    font-size: 14px;
    color: #4b5563;
    font-weight: 500;
}

.sort-bar .results-count strong {
    color: #111827;
    font-weight: 700;
    font-size: 15px;
}

.sort-bar .sort-options {
    display: flex;
    align-items: center;
    gap: 12px;
}

.sort-bar .sort-options label {
    font-size: 14px;
    color: #6b7280;
    margin: 0;
    font-weight: 500;
}

.sort-bar .sort-select {
    padding: 10px 36px 10px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 50px; /* Pill shape */
    font-size: 14px;
    font-weight: 500;
    background: #f9fafb;
    cursor: pointer;
    color: #374151;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 14px;
    transition: all 0.2s ease;
}

.sort-bar .sort-select:hover {
    background-color: #f3f4f6;
    border-color: #d1d5db;
}

.sort-bar .sort-select:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    background-color: white;
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
                        <h4>FILTERS</h4>
                        <button type="button" class="reset-btn" onclick="resetFilters()">
                            Clear All
                        </button>
                    </div>

                    <!-- Filter Body -->
                    <div class="filter-body">

                        <!-- Location Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5>LOCATION</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <select name="district_id" class="custom-filter-select" id="filterDistrict">
                                    <option value="">Select District</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div style="margin-top: 12px;">
                                    <select name="area_id" class="custom-filter-select" id="filterArea" {{ !request('district_id') ? 'disabled' : '' }}>
                                        <option value="">Select Area</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Speciality Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5>SPECIALITY</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content" style="max-height: 240px; overflow-y: auto; padding-right: 4px;">
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
                                <h5>GENDER</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <div class="d-flex align-items-center" style="gap: 12px; background: #f3f4f6; padding: 4px; border-radius: 14px;">
                                    <label class="gender-pill {{ in_array('male', (array)request('gender')) ? 'active' : '' }}" style="margin: 0;">
                                        <input type="checkbox" name="gender[]" value="male"
                                            {{ in_array('male', (array)request('gender')) ? 'checked' : '' }}>
                                        Male
                                    </label>
                                    <label class="gender-pill {{ in_array('female', (array)request('gender')) ? 'active' : '' }}" style="margin: 0;">
                                        <input type="checkbox" name="gender[]" value="female"
                                            {{ in_array('female', (array)request('gender')) ? 'checked' : '' }}>
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Fee Range Section -->
                        <div class="filter-section">
                            <div class="filter-section-header" onclick="toggleSection(this)">
                                <h5>CONSULTATION FEE</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <div class="fee-range-container">
                                    <div class="fee-range-inputs">
                                        <div class="input-group">
                                            <span class="currency-symbol">৳</span>
                                            <input type="number" name="fee_min" placeholder="Min" value="{{ request('fee_min') }}">
                                        </div>
                                        <span class="separator"></span>
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
                                <h5>EXPERIENCE</h5>
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
                                <h5>RATING</h5>
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
                                <h5>SERVICES</h5>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                            <div class="filter-section-content">
                                <div class="toggle-filter">
                                    <span class="toggle-label">
                                        Online Consultation
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="online_consultation" value="1"
                                            {{ request('online_consultation') == '1' ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                                <div class="toggle-filter">
                                    <span class="toggle-label">
                                        Home Visit
                                    </span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="home_visit" value="1"
                                            {{ request('home_visit') == '1' ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                                <div class="toggle-filter">
                                    <span class="toggle-label">
                                        Verified Only
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
