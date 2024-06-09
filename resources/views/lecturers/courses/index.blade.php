@extends('layouts.lecturer')

@section('content')

<div class="container">
    @if ($message = session('message'))
        <div class="alert alert-success mt-4">{{ $message }}</div>
    @endif

    <div class="card mt-5">
        <h2 class="card-header"><b>My Courses</b></h2>
    
        <div class="d-flex justify-content-end mt-3 me-4">
            <div class="col-md-3 me-3">
                <form>
                    <div class="input-group mb-3 ms-3">
                    <input type="text" name="search" value="{{ request()->query('search') }}" id="search-input" class="form-control" placeholder="Search" aria-label="Search..." aria-describedby="button-addon2" style="border-radius: 10px 0 0 10px; border-style: solid hidden solid solid; border-color: grey">
                    <div class="input-group-append">
                        @if(request()->filled('search'))
                        <button id="btn-clear" class="btn btn-outline-secondary" type="button" onclick="document.getElementById('search-input').value = '', this.form.submit()">
                            <i class="fa fa-refresh"></i>
                        </button>
                        @endif
                        <button class="btn btn-outline-secondary " type="submit" id="button-addon2" style="border-radius: 0 10px 10px 0; border-style: solid solid solid hidden;">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </div>
            <div>
                <a href="{{ route('lecturers.courses.create') }}" class="btn btn-primary" style="background-color: #FF9C27; border-color: #FF9C27;">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th width="30%">Course</th>
                    <th width="10%">Category</th>
                    <th width="10%">Duration</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($lCourses as $course)
                        <tr>
                            <td class="d-flex">
                                <div>
                                    @if (empty($course->course_image))
                                        <img src="https://via.placeholder.com/150x150" class="me-3" width="150px">
                                    @else 
                                        <img src="{{ asset('storage/course_images/'.$course->course_image) }}" class="me-3" width="150px">
                                    @endif
                                </div>
                                <div>
                                    <b>{{ $course->title }}</b>
                                </div>
                            </td>
                            <td>{{ $course->category->title }}</td>
                            <td>{{ $course->hours }}h {{ $course->minutes }}m</td>
                            <td>
                                <a href="{{ route('lecturers.courses.edit', $course->id) }}" class="btn btn-primary" style="background-color:#009DA6; border-color:#009DA6">Edit Course</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
            <div class="d-flex justify-content-center">
                {{ $lCourses->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
