@extends('layouts.lecturer')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-center">
        <div class="col-md-6 card p-4 mb-5">
            <h2 class="mb-5"><b>Create Chapter</b></h2>
            <form action="{{ route('lecturers.chapters.store') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
            
                <div class="form-group row">
                    <label for="chapter_no" class="col-md-3 col-form-label fw-bold">Chapter</label>
                    <div class="col-md-9">
                        <select name="chapter_no" id="chapter_no" class="form-control @error('chapter_no') is-invalid @enderror" >
                            <option>Chapter Number</option>
                            @for ($i = 1; $i < 100; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>                          
                        @error('chapter_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-9">
                        <input type="text" name="course_id" id="course_id" value="{{ $course->id }}" class="form-control @error('course_id') is-invalid @enderror" hidden>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lecture_type_id" class="col-md-3 col-form-label fw-bold">Lecture Type</label>
                    <div class="col-md-9">
                        <select name="lecture_type_id" id="lecture_type_id" class="form-control @error('lecture_type_id') is-invalid @enderror">
                            <option>Select Lecture Type</option>
                            @foreach ($lecture_types as $id => $lecture_type)
                                <option value="{{ $id }}">{{ $lecture_type }}</option>                
                            @endforeach
                        </select>
                        @error('lecture_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label fw-bold">Title</label>
                    <div class="col-md-9">
                        <input type="text" name="title" id="title" value="{{ old('title', request()->input('title'))}}" class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lecture" class="col-md-3 col-form-label fw-bold">Lecture</label>
                    <div class="col-md-9">
                        <input type="file" name="lecture" id="lecture" value="{{ old('lecture', request()->input('lecture'))}}" class="form-control @error('lecture') is-invalid @enderror">
                        @error('lecture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="overview" class="col-md-3 col-form-label fw-bold">Overview</label>
                    <div class="col-md-9">
                        <textarea name="overview" id="overview" rows="5" class="form-control @error('overview') is-invalid @enderror">{{ old('overview', request()->input('overview'))}}</textarea>
                        @error('overview')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr style="background-color: black">
            
                <div class="form-group row mb-0">
                    <div class=" d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-3" style="background-color: #009DA6; border-color:#009DA6">Save</button>
                        <a href="{{ route('lecturers.chapters.backButton') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 ms-5 mt-5">
            <h2>Be the leader in a school of fish.</h2>
            <p>Quickly Start creating a chapter here for all your students, current and future.</p>
            <img src="{{url('images/create_chapter_background.png')}}"  width="90%">
        </div>
    </div>
</div>
    
@endsection