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
    <div class="container mb-5">
        @if ($message = session('success'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-title" style="background-color: #009DA6">
                        <div class="d-flex align-items-center">
                            <h2 class="mb-0 ms-2"><b>Manage Categories</b></h2>
                            <div class="ml-auto">
                                <a href="{{ route('admins.categories.create') }}"  style="background-color: #FF9C27" class="btn btn-success">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ms-5 me-5">
                        <div class="d-flex justify-content-end">
                            <div class="col-md-4">
                                <form>
                                    <div class="input-group mb-3 ms-3">
                                      <input type="text" name="search" value="{{ request()->query('search') }}" id="search-input" class="form-control" placeholder="Search" aria-label="Search..." aria-describedby="button-addon2" style="border-radius: 10px 0 0 10px; border-style: solid hidden solid solid; border-color: grey">
                                      <div class="input-group-append">
                                        @if(request()->filled('search'))
                                          <button id="btn-clear" class="btn btn-outline-secondary" type="button" onclick="document.getElementById('search-input').value = '', this.form.submit()">
                                            <i class="fa fa-refresh"></i>
                                          </button>
                                        @endif
                                        <button class="btn btn-outline-secondary " type="submit" id="button-addon2" style="border-radius: 0 10px 10px 0; border-style: solid solid solid hidden;">
                                          <i class="fa fa-search"></i>
                                        </button>
                                      </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">Title</th>
                                <th width="70%">Description</th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index=>$category)
                                    <tr class="text-capitalize">
                                        <th scope="row">{{ $index+1 }}</th>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td >
                                            <a href="{{ route('admins.categories.show', $category->id) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admins.categories.edit', $category->id) }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 

                        <div class="d-flex justify-content-center">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
         
@endsection