@extends('layouts.app')

@section('title', 'Profile Settings - Doccure')

@section('content')
@php
    $fullName = trim($doctor->user->name ?? '');
    $nameParts = preg_split('/\s+/', $fullName, 2);
    $firstName = old('first_name', $nameParts[0] ?? '');
    $lastName = old('last_name', $nameParts[1] ?? '');

    $services = old('services', implode(', ', json_decode($doctor->services ?? '[]', true) ?: []));
    $languages = old('languages', implode(', ', json_decode($doctor->languages ?? '[]', true) ?: []));
    $education = old('education', implode("\n", json_decode($doctor->education ?? '[]', true) ?: []));
    $awards = old('awards', implode("\n", json_decode($doctor->awards ?? '[]', true) ?: []));

    $profileImage = asset('assets/img/doctors/doctor-thumb-02.jpg');
    if (!empty($doctor->profile_image)) {
        $profileImage = str_starts_with($doctor->profile_image, 'uploads/')
            ? asset($doctor->profile_image)
            : asset('storage/' . $doctor->profile_image);
    }
@endphp

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                @include('frontend.includes.doctor-sidebar')
            </div>

            <div class="col-md-7 col-lg-8 col-xl-9">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning">{{ session('warning') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('doctors.profile.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Information</h4>
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="change-avatar">
                                            <div class="profile-img">
                                                <img src="{{ $profileImage }}" alt="User Image">
                                            </div>
                                            <div class="upload-img">
                                                <div class="change-photo-btn">
                                                    <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                    <input type="file" class="upload" name="profile_image" accept="image/*">
                                                </div>
                                                <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Username</label>
                                        <input type="text" class="form-control" readonly value="{{ $doctor->user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" readonly value="{{ $doctor->user->email }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="first_name" value="{{ $firstName }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="last_name" value="{{ $lastName }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $doctor->phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="">Select</option>
                                            <option value="male" {{ old('gender', $doctor->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', $doctor->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', $doctor->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $doctor->date_of_birth) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Experience (Years)</label>
                                        <input type="number" min="0" class="form-control" name="experience_years" value="{{ old('experience_years', $doctor->experience_years) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Professional Details</h4>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Qualification</label>
                                        <input type="text" class="form-control" name="qualification" value="{{ old('qualification', $doctor->qualification) }}" placeholder="MBBS, MD">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Speciality</label>
                                        <select class="form-control" name="speciality_id">
                                            <option value="">Select Speciality</option>
                                            @foreach($specialities as $speciality)
                                                <option value="{{ $speciality->id }}" {{ (string) old('speciality_id', $doctor->speciality_id) === (string) $speciality->id ? 'selected' : '' }}>
                                                    {{ $speciality->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Registration Number</label>
                                        <input type="text" class="form-control" name="registration_number" value="{{ old('registration_number', $doctor->registration_number) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Registration Date</label>
                                        <input type="date" class="form-control" name="registration_date" value="{{ old('registration_date', $doctor->registration_date) }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 mb-0">
                                        <label>Biography</label>
                                        <textarea class="form-control" rows="4" name="bio">{{ old('bio', $doctor->bio) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Clinic and Location</h4>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Clinic Name</label>
                                        <input type="text" class="form-control" name="clinic_name" value="{{ old('clinic_name', $doctor->clinic_name) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Consultation Fee</label>
                                        <input type="number" step="0.01" min="0" class="form-control" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee) }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>Clinic Address</label>
                                        <input type="text" class="form-control" name="clinic_address" value="{{ old('clinic_address', $doctor->clinic_address) }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>District</label>
                                        <select class="form-control" name="district_id" id="district_id">
                                            <option value="">Select District</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" {{ (string) old('district_id', $doctor->district_id) === (string) $district->id ? 'selected' : '' }}>
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Area</label>
                                        <select class="form-control" name="area_id" id="area_id">
                                            <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" {{ (string) old('area_id', $doctor->area_id) === (string) $area->id ? 'selected' : '' }}>
                                                    {{ $area->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="online_consultation" name="online_consultation" value="1" {{ old('online_consultation', $doctor->online_consultation) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="online_consultation">Online Consultation Available</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Online Fee</label>
                                        <input type="number" step="0.01" min="0" class="form-control" name="online_fee" value="{{ old('online_fee', $doctor->online_fee) }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="home_visit" name="home_visit" value="1" {{ old('home_visit', $doctor->home_visit) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="home_visit">Home Visit Available</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Home Visit Fee</label>
                                        <input type="number" step="0.01" min="0" class="form-control" name="home_visit_fee" value="{{ old('home_visit_fee', $doctor->home_visit_fee) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Other Details</h4>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Languages (comma separated)</label>
                                        <input type="text" class="form-control" name="languages" value="{{ $languages }}" placeholder="English, Bangla">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Services (comma separated)</label>
                                        <input type="text" class="form-control" name="services" value="{{ $services }}" placeholder="General checkup, Follow-up">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Website URL</label>
                                        <input type="url" class="form-control" name="website" value="{{ old('website', $doctor->website) }}" placeholder="https://example.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Facebook URL</label>
                                        <input type="url" class="form-control" name="facebook" value="{{ old('facebook', $doctor->facebook) }}" placeholder="https://facebook.com/your-page">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>LinkedIn URL</label>
                                        <input type="url" class="form-control" name="linkedin" value="{{ old('linkedin', $doctor->linkedin) }}" placeholder="https://linkedin.com/in/username">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>Education (one per line)</label>
                                        <textarea class="form-control" rows="3" name="education">{{ $education }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 mb-0">
                                        <label>Awards (one per line)</label>
                                        <textarea class="form-control" rows="3" name="awards">{{ $awards }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section submit-btn-bottom">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const districtSelect = document.getElementById('district_id');
        const areaSelect = document.getElementById('area_id');
        const selectedArea = '{{ old('area_id', $doctor->area_id) }}';

        if (!districtSelect || !areaSelect) {
            return;
        }

        districtSelect.addEventListener('change', function () {
            const districtId = this.value;
            areaSelect.innerHTML = '<option value="">Select Area</option>';

            if (!districtId) {
                return;
            }

            fetch(`/api/areas/${districtId}`)
                .then(response => response.json())
                .then(areas => {
                    (areas || []).forEach(area => {
                        const option = document.createElement('option');
                        option.value = area.id;
                        option.textContent = area.name;
                        if (selectedArea && String(selectedArea) === String(area.id)) {
                            option.selected = true;
                        }
                        areaSelect.appendChild(option);
                    });
                })
                .catch(() => {
                    areaSelect.innerHTML = '<option value="">Select Area</option>';
                });
        });
    });
</script>
@endpush
