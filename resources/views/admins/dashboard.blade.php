@extends('layouts.admin')

@section('content')
<style>
    table{
        border-collapse: separate;
    }
</style>
<div class="d-flex container-fluid vh-100">
    <div class="flex-column flex-shrink-0 text-white bg-dark me-3" style="width: 20%; margin-left:-0.8%">
        <ul class="nav nav-pills flex-column mb-auto ms-3">
            <li class="nav-item">
                <a href="{{ route('admins.dashboard') }}" class="nav-link text-white mb-4 mt-5 fs-6" aria-current="page">
                    <img src="{{asset('/images/cube.png')}}" width="30px" class="me-5">
                    Home
                </a>
                </li>
            <li>
                <a href="{{ route('admins.categories.index') }}" class="nav-link text-white mb-4 ms-2 fs-6">
                    <img src="{{asset('/images/categories.png')}}" width="20px" class="me-5">  
                    Categories
                </a>
            </li>
            <li>
                <a href="{{ route('admins.courses.index') }}" class="nav-link text-white mb-4 fs-6" >
                    <img src="{{asset('/images/courses.png')}}" width="30px" class="me-5">
                    Courses
                </a>
            </li>
            <li>
                <a href="{{ route('admins.users.index') }}" class="nav-link text-white mb-4 fs-6" >
                    <img src="{{asset('/images/users.png')}}" width="30px" class="me-5">
                    Instructors
                </a>
            </li>
        </ul>
    </div>
    <div class="mt-5 ms-5 w-100">
        <div class="col-md-12 row">
            <div class="col-md-6 mb-3">
                <a href="{{ route('admins.categories.index') }}" style="text-decoration: none; color: white">
                    <div class="card border-0 p-3" style="background: linear-gradient(90deg,#ffbf96,#fe7096);">
                        <div class="card-header bg-white border-0" style="background: linear-gradient(90deg,#ffbf96,#fe7096);">
                            <h4>Total Categories</h4>
                        </div>
                        <div class="card-body" style="background: linear-gradient(90deg,#ffbf96,#fe7096);">
                            <div class="d-flex align-items-center justify-content-start">
                                <h2><b>{{ $categories }}</b></h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('admins.courses.index') }}" style="text-decoration: none; color: white">
                    <div class="card border-0 p-3" style="background: linear-gradient(90deg,#90caf9,#047edf 99%);">
                        <div class="card-header bg-white border-0" style="background: linear-gradient(90deg,#90caf9,#047edf 99%);">
                            <h4>Total Courses<h4>
                        </div>
                        <div class="card-body" style="background: linear-gradient(90deg,#90caf9,#047edf 99%);">
                            <div class="d-flex align-items-center justify-content-start">
                                <h2><b>{{ $courses }}</b></h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('admins.users.index') }}" style="text-decoration: none; color: white">
                    <div class="card border-0 p-3" style="background: linear-gradient(90deg,#84d9d2,#07cdae)">
                        <div class="card-header bg-white border-0" style="background: linear-gradient(90deg,#84d9d2,#07cdae)">
                            <h4>Total Instructors<h4>
                        </div>
                        <div class="card-body" style="background: linear-gradient(90deg,#84d9d2,#07cdae)">
                            <div class="d-flex align-items-center justify-content-start">
                                <h2><b>{{ $users }}</b></h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-5 w-100">
            <div class="col-md-12">
                <h3 class="mb-4"><b>New Arrival</b> Courses</h3>
                <table class="table" style="background-color:white;">
                    <tbody>
                        @foreach ($newArrivalCourses as $newArrivalCourse)
                            <tr class="ms-2">                                        
                                <td width="10%">
                                    @if (empty($newArrivalCourse->course_image))
                                        <img src="https://via.placeholder.com/150x150" width="150px">
                                    @else
                                        <img src="{{ asset('storage/course_images/'.$newArrivalCourse->course_image) }}" width="150px">

                                    @endif
                                </td>
                                <td width="70%"><b>{{ $newArrivalCourse->title }}</b> <br> <br> {{ $newArrivalCourse->instructor->name }}</th>
                                <td width="10%"><br><a href="{{ route('admins.courses.edit', $newArrivalCourse->id) }}" class="btn btn-primary" style="background-color:#009DA6; border-color:#009DA6">View Course</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
@endsection