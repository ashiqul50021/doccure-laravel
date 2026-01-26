@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <img src="{{ $course->image ? asset('storage/'.$course->image) : 'https://via.placeholder.com/800x400' }}" class="img-fluid rounded mb-4" alt="{{ $course->title }}">

            <h1>{{ $course->title }}</h1>
            <p class="text-muted">{{ $course->category->name ?? 'Uncategorized' }}</p>

            <div class="mb-4">
                {!! $course->description !!}
            </div>

            <h4>Lessons ({{ $course->lessons->count() }})</h4>
            <ul class="list-group">
                @foreach($course->lessons as $lesson)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $lesson->title }}
                        @if($lesson->is_free)
                            <span class="badge bg-success">Free</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3>৳{{ number_format($course->price) }}</h3>
                    @auth
                        <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg w-100">Enroll Now</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100">Login to Enroll</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
