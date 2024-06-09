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
                    <h3 class="fw-bold mb-0 ms-4">Category Detail</h3>
                </div>           
            <div class="card-body">
                <div class="row ms-3 me-3">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="title" class="col-md-3 col-form-label fw-bold">Title</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext text-muted text-capitalize">{{ $category->title }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label fw-bold">Description</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext text-muted text-capitalize">{{ $category->description }}</p>
                            </div>
                        </div>
                        
                        <hr style="background-color: black">

                        <div class="form-group row mb-0">
                            <div class=" d-flex justify-content-center">
                                <a href="{{ route('admins.categories.edit', $category->id) }}">
                                    <button type="submit" class="btn btn-primary me-3" style="background-color: #009DA6; border-color:#009DA6">Edit</button>
                                </a>
                                <form action="{{ route('admins.categories.destroy', $category->id) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-primary me-3" style="background-color: transparent; border: 1px solid #DC3545; color: #DC3545;">Delete</button>
                                </form>
                                <a href="{{route('admins.categories.index')}}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div> 
@endsection