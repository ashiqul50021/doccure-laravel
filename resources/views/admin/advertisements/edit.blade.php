@extends('layouts.admin')

@section('title', 'Edit Advertisement - Doccure Admin')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Edit Advertisement</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.advertisements.index') }}">Advertisements</a></li>
                <li class="breadcrumb-item active">Edit Advertisement</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.advertisements.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row form-row">
                         <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $advertisement->title }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Link (URL)</label>
                                <input type="url" name="link" class="form-control" value="{{ $advertisement->link }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Speciality (Optional)</label>
                                <select name="speciality_id" class="form-control">
                                    <option value="">All Specialities</option>
                                    @foreach($specialities as $speciality)
                                        <option value="{{ $speciality->id }}" {{ $advertisement->speciality_id == $speciality->id ? 'selected' : '' }}>{{ $speciality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Priority</label>
                                <input type="number" name="priority" class="form-control" value="{{ $advertisement->priority }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $advertisement->start_date ? $advertisement->start_date->format('Y-m-d') : '' }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $advertisement->end_date ? $advertisement->end_date->format('Y-m-d') : '' }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                @if($advertisement->image)
                                    <img src="{{ asset('storage/'.$advertisement->image) }}" alt="" width="50" class="mt-2">
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $advertisement->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Is Active
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
