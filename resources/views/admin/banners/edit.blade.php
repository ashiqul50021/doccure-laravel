@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Edit Banner</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banners</a></li>
                <li class="breadcrumb-item active">Edit Banner</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Banner Type <span class="text-danger">*</span></label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input banner-type" type="radio" name="type" id="type_content" value="content_image" {{ $banner->type == 'content_image' ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_content">
                                    Content with Image (Standard)
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input banner-type" type="radio" name="type" id="type_image" value="image_only" {{ $banner->type == 'image_only' ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_image">
                                    Image Only (Full Width)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Banner Image</label>
                        <input type="file" class="form-control" name="image">
                        <small class="form-text text-muted">Leave empty to keep current image</small>
                        @if($banner->image)
                            <div class="mt-2">
                                <img src="{{ asset($banner->image) }}" alt="Current Banner" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>

                    <!-- Content Fields Wrapper -->
                    <div id="content_fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" value="{{ $banner->title }}" placeholder="e.g. The Largest Online Doctor Platform">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Stats Text (Trusted By)</label>
                                    <input type="text" class="form-control" name="stats_text" value="{{ $banner->stats_text }}" placeholder="e.g. 700,000 Patients">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Subtitle / Description</label>
                            <textarea class="form-control" name="subtitle" rows="3">{{ $banner->subtitle }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Button Text</label>
                                    <input type="text" class="form-control" name="button_text" value="{{ $banner->button_text }}" placeholder="e.g. Consult Now">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Button Link</label>
                                    <input type="text" class="form-control" name="button_link" value="{{ $banner->button_link }}" placeholder="e.g. /search">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Order Priority</label>
                                <input type="number" class="form-control" name="order" value="{{ $banner->order }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Status</label>
                                <div class="status-toggle">
                                    <input type="checkbox" id="is_active" class="check" name="is_active" {{ $banner->is_active ? 'checked' : '' }}>
                                    <label for="is_active" class="checktoggle">checkbox</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Update Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        function toggleFields() {
            if ($('#type_image').is(':checked')) {
                $('#content_fields').hide();
                $('input[name="title"]').prop('required', false);
            } else {
                $('#content_fields').show();
                $('input[name="title"]').prop('required', true);
            }
        }

        // Initial check
        toggleFields();

        // On change
        $('input[name="type"]').change(function() {
            toggleFields();
        });
    });
</script>
@endpush
