@extends('layouts.lecturer')

@section('content')
<div class="d-flex vh-100">
    <div class="flex-column flex-shrink-0 text-white bg-dark me-3" style="width: 20%;">
        <ul class="nav nav-pills flex-column mb-auto ms-3">
          <li class="nav-item">
            <a href="{{ route('lecturers.dashboard') }}" class="nav-link text-white mb-4 mt-5 fs-6" aria-current="page">
                <img src="{{asset('/images/cube.png')}}" width="30px" class="me-5">
                Home
            </a>
            </li>
          <li>
            <a href="{{ route('lecturers.courses.index') }}" class="nav-link text-white mb-4 fs-6" >
                <img src="{{asset('/images/courses.png')}}" width="30px" class="me-5">
                Courses
            </a>
          </li>
          
        </ul>
    </div>
    <div class="mt-5 ms-5 w-100">
        <div class="row">
            <div class="col-md-11 mb-3">
                <a href="{{ route('lecturers.courses.index') }}" style="text-decoration: none; color: white">
                    <div class="card border-0 p-3" style="background: linear-gradient(90deg,#90caf9,#047edf 99%);">
                        <div class="card-header bg-white border-0" style="background: linear-gradient(90deg,#90caf9,#047edf 99%);">
                            <h4>Total Courses<h4>
                        </div>
                        <div class="card-body" style="background: linear-gradient(90deg,#90caf9,#047edf 99%);">
                            <div class="d-flex align-items-center justify-content-start">
                                <h2><b>{{ $coursesCount }}</b></h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
        <div class="row mt-5">
            <div class="col-md-11">
                <h3 class="mb-4"><b>New Arrival</b> Courses</h3>
                <table class="table" style="background-color:white;">
                    <tbody>
                        @foreach ($courses as $course)
                            <tr class="ms-2">                                        
                                <td width="20%">
                                    @if (empty($course->course_image))
                                        <img src="https://via.placeholder.com/150x150" width="150px">
                                    @else
                                        <img src="{{ asset('storage/course_images/'.$course->course_image) }}" width="150px">

                                    @endif
                                </td>
                                <td width="65%"><b>{{ $course->title }}</b> <br> <br> {{ $course->instructor->name }}</th>
                                <td width="20%"><br><a href="{{ route('lecturers.courses.edit', $course->id) }}" class="btn btn-primary" style="background-color:#009DA6; border-color:#009DA6">View Course</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>

@endsection