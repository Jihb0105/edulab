@extends('layouts.admin')

@section('content')
<div class="mt-3" style="margin-left: 10%; margin-right: 10%">
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item border-0" style="font-family: Inter; color: grey; background-color: #11ffee00"><b>{{ auth()->user()->name }}</b></li>
        <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('admins.categories.index') }}" style="color: #009DA6"><b>Manage Categories</b></a></li>
        <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('admins.courses.index') }}" style="color: grey"><b>Manage Courses</b></a></li>
        <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('admins.users.index') }}" style="color: grey"><b>Manage Users</b></a></li>
    </ul>
    <hr style="background-color: black">
</div>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-title" style="background-color: #009DA6;">
                    <h3 class="fw-bold mb-0 ms-4">Edit Detail</h3>
                </div>           
                <div class="card-body">
                    <div class="row ms-3 me-3">
                        <div class="col-md-12">
                            <form action="{{ route('admins.categories.update', $category->id) }}" method="POST">
                                @method('PUT')
                                @csrf

                                <div class="form-group row">
                                    <label for="title" class="col-md-3 col-form-label fw-bold">Title</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title" id="title" class="text-capitalize form-control @error('title') is-invalid @enderror" value="{{ $category->title }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-md-3 col-form-label fw-bold">Description</label>
                                    <div class="col-md-9">
                                        <textarea name="description" id="description" rows="5" class=" text-capitalize form-control @error('description') is-invalid @enderror">{{ $category->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <hr style="background-color: black">

                                <div class="form-group row mb-0 ">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary me-3" style="background-color: #009DA6; border-color:#009DA6">Save</button>
                                        <a href="{{route('admins.categories.index')}}" class="btn btn-outline-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection