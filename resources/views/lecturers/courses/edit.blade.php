@extends('layouts.lecturer')

@section('content')

<div class="container col-md-8">
    @if ($message = session('message'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="d-flex col-md-12 mt-5" style="margin-left:-2%;">
        <h2 style="color: #009DA6;" class="mb-4"><b>Edit Courses</b></h2>
        <div class="d-flex ms-auto">
            <form action="{{ route('lecturers.courses.destroy', $course->id) }}" method="POST">
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn btn-primary" style="background-color: transparent; border: 1px solid #DC3545; color: #DC3545;">Delete</button>
            </form>
        </div>
    </div>
    <form action="{{ route('lecturers.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-7 me-3">
                <p style="color: #009DA6" class="mb-0">BASIC INFORMATION</p>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label fw-bold">COURSE TITLE</label>
                    <div class="col-md-12">
                        <input type="text" name="title" id="title" value="{{ $course->title }}" class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="course_overview" class="col-md-4 col-form-label fw-bold">COURSE OVERVIEW</label>
                    <div class="col-md-12">
                        <textarea name="course_overview" id="course_overview" rows="5" class="form-control @error('course_overview') is-invalid @enderror">{{ $course->course_overview }}</textarea>
                        @error('course_overview')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="d-flex col-md-12 mb-3">
                        <p style="color: #009DA6" class="mb-4">CHAPTERS</p>
                        <a href="{{ route('lecturers.chapters.create', $course->id) }}" class="btn btn-primary ms-auto mb-2" style="background-color: #FF9C27; border-color: #FF9C27;"><b>Add New</b></a>
                    </div>
                    @foreach ($chapters as $chapter)
                        <div class="d-flex">
                            <a href="{{ route('lecturers.chapters.edit', $chapter->id) }}" class="btn btn-primary col-md-11 ms-auto me-auto mb-4" style="background-color:#009DA6; border-color:#009DA6">{{ $chapter->chapter_no }}: {{ $chapter->title }} 
                            </a>
                            <a href="{{ route('users.discussion', $chapter->id) }}" class="btn btn-secondary mb-4 align-items-center d-flex">
                                <i class="bi bi-file-post-fill"></i>
                            </a>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center">
                        {{ $chapters->links() }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group row">
                    <p style="color: #009DA6;" class="mb-0">POSTER</p>
                    <label for="course_image" class="col-form-label fw-bold">COURSE IMAGE</label>
                    <div class="card p-2" style="width: 18rem;">
                        @if (empty($course->course_image))
                            <img src="https://via.placeholder.com/150x150" class="card-img-top" alt="...">
                        @else 
                            <img src="{{ asset('storage/course_images/'.$course->course_image) }}" class="img-fluid" alt="Upload poster image">
                        @endif

                        <div class="card-body">
                            <div>
                                <input type="file" name="course_image" id="course_image" value="{{ $course->course_image }}" class="form-control @error('course_image') is-invalid @enderror">
                                @error('course_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <p style="color: #009DA6" class="mb-0">OPTIONS</p>
                    <div class="col-md-12" style="margin-left:-5.5%">
                        <label for="category_id" class="col-md-4 col-form-label fw-bold">CATEGORY</label>
                        <div class="col-md-12">
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach ($categories as $id => $title)
                                <option value="{{ $id }}" @selected($id == old('category_id', $course->category_id))>{{ $title }}</option>                
                            @endforeach
                        </select>
                        @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mt-2" style="margin-left:-5.5%">
                        <div class="col-md-12">
                            <input type="text" name="instructor_id" id="instructor_id" value="{{ auth()->user()->id }}" class="form-control @error('instructor_id') is-invalid @enderror" hidden>
                            @error('instructor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <p style="color: #009DA6" class="mb-0">DURATION</P>
                    <div class="col-md-12">
                        <label for="hours" class="col-form-label fw-bold">HOURS</label>
                        <div class="col-md-12" style="margin-left: -5.5%">
                            <select name="hours" id="hours" class="form-control @error('hours') is-invalid @enderror" >
                                <option value="">Hours</option>
                                @for ($i = 0; $i < 100; $i++)
                                    <option value="{{ $i }}" @selected($i == old('hours', $course->hours))>{{ $i }}</option>
                                @endfor
                            </select>                                
                            @error('hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="minutes" class="col-form-label fw-bold">MINUTES</label>
                        <div class="col-md-12" style="margin-left: -5.5%">
                            <select name="minutes" id="minutes" class="form-control @error('minutes') is-invalid @enderror" >
                                <option value="" selected>Minutes</option>
                                @for ($i = 0; $i < 60; $i++)
                                    <option value="{{ $i }}" @selected($i == old('minutes', $course->minutes))>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('minutes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> 

            </div> 
            <div class="form-group row mb-4 d-flex justify-content-center">
                <div class="col-md-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-3" style="background-color: #009DA6; border-color:#009DA6">Update</button>                  
                    <a href="{{ route('lecturers.courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
      
</div>

@endsection