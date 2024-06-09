@extends('layouts.lecturer')

@section('content')
    <div class="container">
        @if ($message = session('message'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif

        <div class="card mt-5">
            <h2 class="card-header card-title" style="background-color:#009DA6"><b>Chapter {{ $chapter->chapter_no }} Resources</b></h2>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <div class="me-3">
                        <a href="{{ route('lecturers.resource.backButton') }}" class="btn btn-secondary">Back</a>
                    </div>
                    <div>
                        <a href="{{ route('lecturers.resource.create', $chapter->id) }}" class="btn btn-primary" style="background-color: #FF9C27; border-color: #FF9C27;">Add New</a>
                    </div>
                </div>
        
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
                                    <a href="{{ route('lecturers.resource.edit', $resource->id) }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('lecturers.resource.destroy', $resource->id) }}" method="POST">
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
