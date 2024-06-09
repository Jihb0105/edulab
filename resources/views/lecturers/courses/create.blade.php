@extends('layouts.lecturer')

@section('content')

<div class="container mt-5">
    <div class="d-flex">
        <div class="col-md-6 me-5">
            <h2>Great! Your students are waiting</h2>
            <p>Quickly Start creating a course here for all your students, current and future.</p>
            <img src="{{url('images/create_course_background.png')}}"  width="90%">
        </div>
        <div class="col-md-6 card p-4 mb-5">
            <h2 class="mb-5"><b>Create Course</b></h2>
            <form action="{{ route('lecturers.courses.store') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group row">
                            <label for="title" class="col-md-3 col-form-label fw-bold">Title</label>
                            <div class="col-md-9">
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="course_image" class="col-md-3 col-form-label fw-bold">Course Image</label>
                            <div class="col-md-9">
                                <input type="file" name="course_image" id="course_image" class="form-control @error('course_image') is-invalid @enderror">
                                @error('course_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_id" class="col-md-3 col-form-label fw-bold">Category</label>
                            <div class="col-md-9">
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $id => $title)
                                    <option value="{{ $id }}">{{ $title }}</option>                
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9">
                                <input type="text" name="instructor_id" id="instructor_id" value="{{ auth()->user()->id }}" class="form-control @error('instructor_id') is-invalid @enderror" hidden>
                                @error('instructor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hours" class="col-md-3 col-form-label fw-bold">Hours</label>
                            <div class="col-md-9">
                            <select name="hours" id="hours" class="form-control @error('hours') is-invalid @enderror" >
                                <option>Hours</option>
                                @for ($i = 0; $i < 100; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>                                
                            @error('hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="minutes" class="col-md-3 col-form-label fw-bold">Minutes</label>
                            <div class="col-md-9">
                                <select name="minutes" id="minutes" class="form-control @error('minutes') is-invalid @enderror" >
                                    <option selected>Minute</option>
                                    @for ($i = 0; $i < 60; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('minutes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="course_overview" class="col-md-3 col-form-label fw-bold">Course Overview</label>
                            <div class="col-md-9">
                                <textarea name="course_overview" id="course_overview" rows="5" class="form-control @error('course_overview') is-invalid @enderror"></textarea>
                                @error('course_overview')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group row mb-0 ">
                            <div class="col-md-12 justify-content-center d-flex">
                                <button type="submit" class="btn btn-primary me-3" style="background-color:#009DA6; border-color:#009DA6">Save</button>
                                <a href="{{ route('lecturers.courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection