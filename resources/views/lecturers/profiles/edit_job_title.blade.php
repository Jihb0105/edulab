@extends('layouts.lecturer')

@section('content')
<div class="container mt-5">
    <div class="d-flex col-md-12" style="margin-left:-3.5%;">
        <h2 class="mb-5"><b>Edit Qualification</b></h2>
        <form action="{{ route('lecturers.settings.profile.jobTitle.destroy', $job_title->id) }}" method="POST" class="ms-auto">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-primary me-3" style="background-color: transparent; border: 1px solid #DC3545; color: #DC3545;">Delete</button>
        </form>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-7 card p-4 mb-5">
            <form action="{{ route('lecturers.settings.profile.jobTitle.update', $job_title->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
        
                <div class="form-group row">
                    <div class="col-md-9">
                        <input type="text" name="instructor_id" id="instructor_id" value="{{ $job_title->instructor_id }}" class="form-control @error('instructor_id') is-invalid @enderror" hidden>
                        @error('instructor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="job_title" class="col-md-3 col-form-label fw-bold">Qualification</label>
                    <div class="col-md-9">
                        <input type="text" name="job_title" id="job_title" value="{{ $job_title->job_title }}" class="form-control @error('job_title') is-invalid @enderror">
                        @error('job_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr style="background-color: black">
            
                <div class="form-group row mb-0">
                    <div class=" d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-3" style="background-color: #009DA6; border-color:#009DA6">Update</button>
                        <a href="javascript:history.back()" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection