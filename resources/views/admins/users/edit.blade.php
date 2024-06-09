@extends('layouts.admin')

@section('content')
    <div class="mt-3" style="margin-left: 10%; margin-right: 10%">
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item border-0" style="font-family: Inter; color: grey; background-color: #11ffee00"><b>{{ auth()->user()->name }}</b></li>
            <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('admins.categories.index') }}" style="color: grey"><b>Manage Categories</b></a></li>
            <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('admins.courses.index') }}" style="color: grey"><b>Manage Courses</b></a></li>
            <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('admins.users.index') }}" style="color: #009DA6"><b>Manage Users</b></a></li>
        </ul>
        <hr style="background-color: black">
    </div>
    <div class="container mt-4">
        <div class="card">
            <h3 class="card-header fw-bold">Instructor Application</h3>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label fw-bold">Name</label>
                    <div class="col-md-10">
                        <input type="text" name="name" id="name" value="{{ $lecturer->name }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label fw-bold">Email</label>
                    <div class="col-md-10">
                        <p class="form-control">{{ $lecturer->email }}</p>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="lecturer_description" class="col-md-2 col-form-label fw-bold">Employment Pitch</label>
                    <div class="col-md-10">
                        <p class="border p-2">{{ $lecturer->lecturer_description }}</p>
                    </div>
                </div>
                <div class="row ">
                    <div class="form-group row col-md-6">
                        <label for="lecturer_cv" class="col-form-label fw-bold justify-content-end d-flex">Instructor Resume</label>
                        <div class="justify-content-end d-flex">
                            <a class="btn btn-primary" href="{{ route('admins.users.downloadCv', $lecturer->lecturer_cv) }}" style="background-color:#009DA6; border-color:#009DA6">Download</a>
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="approval" class="col-form-label fw-bold justify-content-start d-flex">Instructor Approval</label>
                        <div class="justify-content-start d-flex">
                            @if ($lecturer->approved == 0)
                                <a class="btn btn-primary me-2" href="{{ route('admins.users.approve', $lecturer->id) }}" style="background-color:#009DA6; border-color:#009DA6">Approve</a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" style="background-color:#FF003C; border-color:#FF003C" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                    Reject
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reasons for Rejection</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea id="reject_reason" class="form-control @error('reject_reason') is-invalid @enderror" name="reject_reason" rows="5"></textarea>
                                            @error('lecturer_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-primary" href="{{ route('admins.users.reject', $lecturer->id) }}">Reject Instructor</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @elseif ($lecturer->approved == 1)
                                <p class="">Approved</p>
                            @else
                                <p class="">Rejected</p>
                            @endif
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection