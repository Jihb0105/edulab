@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5">
        @if ($message = session('message'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif
        <div class="card">
            <div class="card-header d-flex col-md-12">
                <div class="col-md-11 mt-2">
                    <h4 class="fw-bold">Video Call Lists</h4>
                </div>
                <div class="d-flex justify-content-end">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="background-color: #FF9C27; border-color: #FF9C27;">
                        <b>Create Call</b>
                    </button>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create New Video Call</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('admins.live_chat.store') }}" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                
                                <div class="modal-body">
                                    <div class="form-group row px-3">
                                        <label for="topic" class="col-md-3 col-form-label fw-bold">Topic</label>
                                        <div class="col-md-9">
                                            <input type="text" name="topic" id="topic" class="form-control @error('topic') is-invalid @enderror">
                                            @error('topic')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row px-3">
                                        <label for="start_time" class="col-md-3 col-form-label fw-bold">Start Time</label>
                                        <div class="col-md-9">
                                            <input type="datetime-local" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror">
                                            @error('start_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Create Meeting</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover mt-3 mb-5">
                    <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">User</th>
                        <th width="40%">Topic</th>
                        <th width="10%">Start At </th>
                        <th width="10%">Duration</th>
                        <th width="10%">Join Url</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($liveChats as $index=>$liveChat)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $liveChat->user->name }}</td>
                                <td>{{ $liveChat->topic }}</td>
                                <td>{{ date('d M Y H:i', strtotime($liveChat->start_at)) }}</td>
                                <td>{{ $liveChat->duration }} min</td>
                                <td class="text-danger"><a href="{{$liveChat->join_url}}" target="_blank">URL</a></td>
                                <td>
                                    <form action="{{route('admins.live_chat.destroy')}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <input name="id" value="{{$liveChat->meeting_id}}" hidden>
                                            <button type="submit" class="btn btn-sm btn-circle btn-outline-secondary" style="background-color: transparent; border: 1px solid #DC3545; color: #DC3545;"><i class="fa fa-trash" style="color: red"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
                <div class="d-flex justify-content-center">
                    {{ $liveChats->links() }}
                </div>
            </div>
        </div>
    </div>
    

@endsection