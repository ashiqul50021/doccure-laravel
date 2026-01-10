@extends('layouts.admin')

@section('title', 'Site Settings - Doccure Admin')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Site Settings</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Site Settings</li>
            </ul>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <!-- General Settings -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-cog mr-2"></i>General Settings</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Website Name</label>
                        <input type="text" class="form-control" name="site_name" value="{{ $generalSettings['site_name'] ?? 'Doccure' }}">
                    </div>

                    <div class="form-group">
                        <label>Tagline</label>
                        <input type="text" class="form-control" name="site_tagline" value="{{ $generalSettings['site_tagline'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Website Logo</label>
                        @if(!empty($generalSettings['logo']))
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$generalSettings['logo']) }}" alt="Logo" style="max-height: 50px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="logo">
                        <small class="text-muted">Recommended size: 200px x 50px</small>
                    </div>

                    <div class="form-group">
                        <label>Favicon</label>
                        @if(!empty($generalSettings['favicon']))
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$generalSettings['favicon']) }}" alt="Favicon" style="max-height: 32px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="favicon">
                        <small class="text-muted">Recommended size: 32px x 32px (PNG or ICO)</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Save General Settings</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Contact Settings -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-phone mr-2"></i>Contact Settings</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.site-settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="email" class="form-control" name="contact_email" value="{{ $contactSettings['contact_email'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Contact Phone</label>
                        <input type="text" class="form-control" name="contact_phone" value="{{ $contactSettings['contact_phone'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="contact_address" rows="3">{{ $contactSettings['contact_address'] ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Contact Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Social Links -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-share-alt mr-2"></i>Social Links</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.site-settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label><i class="fab fa-facebook mr-1"></i>Facebook URL</label>
                        <input type="url" class="form-control" name="facebook_url" value="{{ $socialSettings['facebook_url'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-twitter mr-1"></i>Twitter URL</label>
                        <input type="url" class="form-control" name="twitter_url" value="{{ $socialSettings['twitter_url'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-instagram mr-1"></i>Instagram URL</label>
                        <input type="url" class="form-control" name="instagram_url" value="{{ $socialSettings['instagram_url'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-linkedin mr-1"></i>LinkedIn URL</label>
                        <input type="url" class="form-control" name="linkedin_url" value="{{ $socialSettings['linkedin_url'] ?? '' }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Social Links</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Banner Settings -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-image mr-2"></i>Banner Settings</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.site-settings.update-banner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Banner Title</label>
                        <input type="text" class="form-control" name="banner_title" value="{{ $bannerSettings['banner_title'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Banner Subtitle</label>
                        <input type="text" class="form-control" name="banner_subtitle" value="{{ $bannerSettings['banner_subtitle'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Stats Text (e.g., "5K+ Appointments")</label>
                        <input type="text" class="form-control" name="banner_stats_text" value="{{ $bannerSettings['banner_stats_text'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label>Rating</label>
                        <input type="text" class="form-control" name="banner_rating" value="{{ $bannerSettings['banner_rating'] ?? '5.0' }}">
                    </div>

                    <div class="form-group">
                        <label>Banner Image</label>
                        @if(!empty($bannerSettings['banner_image']))
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$bannerSettings['banner_image']) }}" alt="Banner" style="max-height: 100px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="banner_image">
                        <small class="text-muted">Recommended size: 600px x 600px</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Banner Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
