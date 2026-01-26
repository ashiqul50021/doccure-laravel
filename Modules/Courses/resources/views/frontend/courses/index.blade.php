@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Courses</h1>

    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $course->image ? asset('storage/'.$course->image) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $course->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text text-muted">{{ $course->category->name ?? 'Uncategorized' }}</p>
                        <p class="card-text">৳{{ number_format($course->price) }}</p>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">View Course</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No courses available yet.</p>
            </div>
        @endforelse
    </div>

    {{ $courses->links() }}
</div>
@endsection
