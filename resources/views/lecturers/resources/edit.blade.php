@extends('layouts.lecturer')

@section('content')
    
<div class="container mt-5 px-5">
    <div class="card d-flex justify-align-center">
        <h2 class="card-header card-title" style="background-color:#009DA6"><b>Edit Resource</b></h2>
        <div class="card-body">
            <form action="{{ route('lecturers.resource.update', $resource->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <div class="col-md-9">
                        <input type="text" name="chapter_id" id="chapter_id" value="{{ $resource->chapter_id }}" class="form-control @error('chapter_id') is-invalid @enderror" hidden>
                        @error('chapter_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="resource" class="col-md-3 col-form-label fw-bold">Resource</label>
                    <div class="col-md-9">
                        <input type="file" name="resource" id="resource" class="form-control @error('resource') is-invalid @enderror">
                        @error('resource')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <hr style="background-color: black">
            
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