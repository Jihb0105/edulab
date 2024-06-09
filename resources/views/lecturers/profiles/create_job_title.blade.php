@extends('layouts.lecturer')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-center">
        <div class="col-md-7 card p-5 mb-5">
            <h2 class="mb-3"><b>Add Qualification</b></h2>
            <form action="{{ route('lecturers.settings.profile.jobTitle.store') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
        
                <div class="form-group row">
                    <div class="col-md-9">
                        <input type="text" name="instructor_id" id="instructor_id" value="{{ auth()->user()->id }}" class="form-control @error('instructor_id') is-invalid @enderror" hidden>
                        @error('instructor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="job_title" class="col-md-3 col-form-label fw-bold">Qualification</label>
                    <div class="col-md-9">
                        <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror">
                        @error('job_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="mt-5" style="background-color: black">
            
                <div class="form-group row mb-0">
                    <div class=" d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-3" style="background-color: #009DA6; border-color:#009DA6">Save</button>
                        <a href="javascript:history.back()" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection