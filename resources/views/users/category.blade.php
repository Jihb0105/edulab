@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="mb-4 mt-2">{{ $category->title }} Courses</h2>
    @foreach ($courses as $course)
    <a href="{{ route('users.course', $course->id) }}" style="color: black; text-decoration: none">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="col-md-3 d-flex justify-content-center">
                @if (empty($course->course_image))
                    <img src="https://via.placeholder.com/150x150" class="mt-3" width="300" height="150">
                @else 
                    <img src="{{ asset('storage/course_images/'.$course->course_image) }}" class="mt-3" width="300" height="150">
                @endif
            </div>
            <div class="col-md-9 mt-3">
                <h5><b>{{ $course->title }}</b></h6>
                <p>{{ $course->course_overview }}</p>
                <p style="color: grey">{{ $course->hours }}h {{ $course->minutes }}m . {{ $course->instructor->name }}</p>
            </div>
        </div>
    </a>
        <hr style="border-top: 2px solid black;">
    @endforeach

    <div class="d-flex justify-content-center mt-3">
        {{ $courses->links() }}
    </div>
</div>
    
@endsection