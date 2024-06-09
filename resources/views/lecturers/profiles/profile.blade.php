@extends('layouts.lecturer')

@section('content')
    @if ($message = session('message'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    <div class="container rounded bg-white mt-5 mb-5 p-5">
        <form action="{{ route('lecturers.settings.profile.update', $user->id) }}" enctype="multipart/form-data" method="POST">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center mt-5">
                        <div class="p-2 rounded-circle">
                            @if (empty($user->profile_picture))
                                <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" class="rounded-circle" style="width: 200px;">
                            @else 
                                <img src="{{ asset('storage/profile_pictures/'.$user->profile_picture) }}" class="rounded-circle" alt="Upload poster image" style="width: 200px; height:200px; border: 3px solid black;">
                            @endif
                        </div>
                        <div class="card-body">
                            <div>
                                <input type="file" name="profile_picture" id="profile_picture" value="{{ $user->profile_picture }}" class="form-control @error('profile_picture') is-invalid @enderror">
                                @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <span class="font-weight-bold">{{ $user->name }}</span>
                    </div>
                    <div class="text-center">
                        <p class="font-weight-bold fs-5 mt-5" style="color: #808080">My Account</p>
                        <p class="fs-6"><a href="{{ route('lecturers.settings.profile.edit') }}" style="color:#009DA6;">Profile</a></p>
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5 mt-5">
                        <div class="col-md-12" style="margin-left: -4%">
                            <h4><b>Profile Page</b></h4>
                            <p>Edit Information about Yourself</p>                            
                        </div>
                        <hr style="border-top: 2px solid black">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" hidden>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Birth Date</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control mb-3 @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $user->birth_date) }}">
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Biography</label>
                                <textarea name="description" id="description" rows="5" class="form-control mb-3 p-4 @error('description') is-invalid @enderror">{{ old('description', $user->description) }}</textarea>
                                @error('user_overview')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit" style="background-color: #009DA6; border-color:#009DA6">Save Profile</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: transparent; border: 1px solid #DC3545; color: #DC3545;">
                                    Delete User
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5 mt-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Edit Qualifications</span>
                            <a href="{{ route('lecturers.settings.profile.jobTitle.create', auth()->user()->id) }}">
                                <span class="border px-3 p-1">
                                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Qualification
                                </span>
                            </a>
                        </div>
                        <br>
                        <div class="col-md-12">
                            @foreach ($job_titles as $job_title)
                                <a href="{{ route('lecturers.settings.profile.jobTitle.edit', $job_title->id) }}" class="btn btn-primary col-md-12 mb-4" style="background-color:#009DA6; border-color:#009DA6">{{ $job_title->job_title }}</a>
                            @endforeach
                        </div> 
                    </div>
                </div>
            </div>
        </form>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('lecturers.settings.profile.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


    

