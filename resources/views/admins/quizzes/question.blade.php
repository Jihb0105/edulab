@extends('layouts.lecturer')

@section('content')
    <div class="container mt-5">
        <div class="card mt-5">
            <div class="card-header" style="background-color:#009DA6">
                <div class="d-flex">
                    <h2 class="card-title col-md-11 " style="background-color:#009DA6"><b>Manage Quiz</b></h2>
                    <a href="{{ route('admins.quiz.backButton') }}" class="btn btn-secondary col-md-1 mt-3 mb-4">Back</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover mt-3">
                    <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="80%">Question</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td>{{ $question->question_no}}</td>
                                <td>{{ $question->question}}</td>
                                <td class="d-flex">
                                    <a href="{{ route('admins.quiz.edit', $question->id) }}" class="btn btn-sm btn-circle btn-outline-secondary">
                                        <i class="fa fa-edit"></i>                            
                                    </a>
                                    <form action="{{ route('admins.quiz.destroy', $question->id) }}" method="POST">
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
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection