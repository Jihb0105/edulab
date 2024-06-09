@extends('layouts.lecturer')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header" style="background-color:#009DA6">
                <div class="d-flex" style="margin-bottom: -2%">
                    <h2 class="card-title col-md-9" style="background-color:#009DA6"><b>Manage Quizzes</b></h2>
                    <div class="col-md-3 d-flex mt-3">
                        <div class="me-3">
                            <a href="{{ route('lecturers.quiz.backButton') }}" class="btn btn-secondary fs-5">Back</a>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary fs-5 mb-5" style="background-color: #FF9C27; border-color: #FF9C27;" data-bs-toggle="modal" data-bs-target="#add">
                            Add New
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addModelLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModelLabel">Add Question</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
        
                                    <form action="{{ route('lecturers.quiz.store', $chapter->id) }}" method="POST" enctype="multipart/form-data">
                                        @method('POST')
                                        @csrf                            
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-md-9">
                                                    <input type="text" name="chapter_id" id="chapter_id" value="{{ $chapter->id }}" class="form-control @error('chapter_id') is-invalid @enderror" hidden>
                                                    @error('chapter_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="question_no" class="col-md-3 col-form-label fw-bold">Question No</label>
                                                <div class="col-md-9">
                                                <select name="question_no" id="question_no" class="form-control @error('question_no') is-invalid @enderror" >
                                                    @for ($i = 1; $i < 100; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                    
                                                </select>                                
                                                @error('question_no')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="question" class="col-md-3 col-form-label fw-bold">Question:</label>
                                                <div class="col-md-12">
                                                    <textarea name="question" id="question" rows="3" class="form-control @error('question') is-invalid @enderror"></textarea>
                                                    @error('question')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-left:-5%">
                                                <div class="col-md-6">
                                                    <label for="a" class="col-md-3 col-form-label fw-bold">A:</label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="a" id="a" class="form-control @error('a') is-invalid @enderror">
                                                        @error('a')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="b" class="col-md-3 col-form-label fw-bold">B:</label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="b" id="b" class="form-control @error('b') is-invalid @enderror">
                                                        @error('b')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-left:-5%">
                                                <div class="col-md-6">
                                                    <label for="c" class="col-md-3 col-form-label fw-bold">C:</label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="c" id="c" class="form-control @error('c') is-invalid @enderror">
                                                        @error('c')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="d" class="col-md-3 col-form-label fw-bold">D:</label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="d" id="d" class="form-control @error('d') is-invalid @enderror">
                                                        @error('d')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="answer" class="col-md-3 col-form-label fw-bold">Answer:</label>
                                                <div class="col-md-12">
                                                    <select name="answer">
                                                        <option value="a">A</option>
                                                        <option value="b">B</option>
                                                        <option value="c">C</option>
                                                        <option value="d">D</option>
                                                    </select>
                                                    @error('answer')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary me-auto ms-auto" style="background-color:#009DA6; border-color:#009DA6">Add Question</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <a href="{{ route('lecturers.quiz.edit', $question->id) }}" class="btn btn-sm btn-circle btn-outline-secondary">
                                        <i class="fa fa-edit"></i>                            
                                    </a>
                                    <form action="{{ route('lecturers.quiz.destroy', $question->id) }}" method="POST">
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