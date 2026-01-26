@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Add Banner</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banners</a></li>
                <li class="breadcrumb-item active">Add Banner</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Banner Type <span class="text-danger">*</span></label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input banner-type" type="radio" name="type" id="type_content" value="content_image" checked>
                                <label class="form-check-label" for="type_content">
                                    Content with Image (Standard)
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input banner-type" type="radio" name="type" id="type_image" value="image_only">
                                <label class="form-check-label" for="type_image">
                                    Image Only (Full Width)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Banner Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="image" required>
                        <small class="form-text text-muted">Recommended Size: 1920x600px (Image Only) or Transparent PNG (Content with Image)</small>
                    </div>

                    <!-- Content Fields Wrapper -->
                    <div id="content_fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="e.g. The Largest Online Doctor Platform">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stats Text (Trusted By)</label>
                                    <input type="text" class="form-control" name="stats_text" placeholder="e.g. 700,000 Patients">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Subtitle / Description</label>
                            <textarea class="form-control" name="subtitle" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button Text</label>
                                    <input type="text" class="form-control" name="button_text" placeholder="e.g. Consult Now">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button Link</label>
                                    <input type="text" class="form-control" name="button_link" placeholder="e.g. /search">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Order Priority</label>
                                <input type="number" class="form-control" name="order" value="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <div class="status-toggle">
                                    <input type="checkbox" id="is_active" class="check" name="is_active" checked>
                                    <label for="is_active" class="checktoggle">checkbox</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Save Banner</button>
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
