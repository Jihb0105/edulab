@extends('layouts.admin')

@section('content')
<div class="mt-3" style="margin-left: 10%; margin-right: 10%">
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item border-0" style="font-family: Inter; color: grey; background-color: #11ffee00"><b>{{ auth()->user()->name }}</b></li>
        <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('admins.categories.index') }}" style="color: grey"><b>Manage Categories</b></a></li>
        <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('admins.courses.index') }}" style="color: #009DA6"><b>Manage Courses</b></a></li>
        <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('admins.users.index') }}" style="color: grey"><b>Manage Users</b></a></li>
    </ul>
    <hr style="background-color: black">
</div>
<div class="container mt-5">
    @if ($message = session('message'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    <div class="card">
        <h2 class="card-header card-title" style="background-color: #009DA6"><b>All Courses</b></h2>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="col-md-4">
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
                
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Course</th>
                    <th scope="col">Instructor</th>
                    <th scope="col">Category</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($aCourses as $index=>$course)
                        <tr class="text-capitalize">
                            <td class="d-flex">
                                <div>
                                    @if (empty($course->course_image))
                                        <img src="https://via.placeholder.com/150x150" class="me-3" width="120px">
                                    @else 
                                        <img src="{{ asset('storage/course_images/'.$course->course_image) }}" class="me-3" width="120px">
                                    @endif
                                </div>
                                <div>
                                    <b>{{ $course->title }}</b>
                                </div>
                            </td>
                            <td>{{ $course->instructor->name }}</td>
                            <td width="20%">{{ $course->category->title }}</td>
                            <td>{{ $course->hours }}h {{ $course->minutes }}m</td>
                            <td width="150">
                                <a href="{{ route('admins.courses.edit', $course->id) }}" class="btn btn-primary" style="background-color:#009DA6; border-color:#009DA6">View Course</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
            <div class="d-flex justify-content-center">
                {{ $aCourses->links() }}
            </div>
        </div>
      </div>
    
</div>

@endsection