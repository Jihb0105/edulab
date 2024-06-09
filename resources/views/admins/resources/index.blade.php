@extends('layouts.admin')

@section('content')
    <div class="container">
        @if ($message = session('message'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif

        <div class="card mt-5">
            <div class="card-header" style="background-color:#009DA6">
                <div class="d-flex">
                    <h2 class="card-title col-md-11 " style="background-color:#009DA6"><b>Chapter {{ $chapter->chapter_no }} Resources</b></h2>
                    <a href="{{ route('admins.resource.backButton') }}" class="btn btn-secondary col-md-1 mt-3 mb-4">Back</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover mt-3">
                    <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th width="80%">Resource Path</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($resources as $index=>$resource)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $resource->resource }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('admins.resource.edit', $resource->id) }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('admins.resource.destroy', $resource->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-circle btn-outline-secondary" style="background-color: transparent; border: 1px solid #DC3545; color: #DC3545;"><i class="fa fa-trash" style="color: red"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
                <div class="d-flex justify-content-center">
                    {{ $resources->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
