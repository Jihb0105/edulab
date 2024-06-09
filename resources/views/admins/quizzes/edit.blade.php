@extends('layouts.lecturer')
@section('content')
    <div class="container justify-content-center d-flex">
        <div class="card mt-5 col-md-9">
            <div class="card-body">
                <h2 class="mt-3 ms-3"><b>Edit Question</b></h2>
                <form action="{{ route('admins.quiz.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf                            
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-9">
                                <input type="text" name="chapter_id" id="chapter_id" value="{{ $question->chapter_id }}" class="form-control @error('chapter_id') is-invalid @enderror" hidden>
                                @error('chapter_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="question_no" class="col-md-3 col-form-label fw-bold">Question No</label>
                            <div class="col-md-9">
                            <select name="question_no" id="question_no" value="{{ $question->question_no }}" class="form-control @error('question_no') is-invalid @enderror" >
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
                                <textarea name="question" id="question" rows="3" class="form-control @error('question') is-invalid @enderror">{{ $question->question }}</textarea>
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="margin-left:-2%">
                            <div class="col-md-6">
                                <label for="a" class="col-md-3 col-form-label fw-bold">A:</label>
                                <div class="col-md-12">
                                    <input type="text" name="a" id="a" value="{{ $question->a }}" class="form-control @error('a') is-invalid @enderror">
                                    @error('a')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="b" class="col-md-3 col-form-label fw-bold">B:</label>
                                <div class="col-md-12">
                                    <input type="text" name="b" id="b" value="{{ $question->b }}" class="form-control @error('b') is-invalid @enderror">
                                    @error('b')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-left:-2%">
                            <div class="col-md-6">
                                <label for="c" class="col-md-3 col-form-label fw-bold">C:</label>
                                <div class="col-md-12">
                                    <input type="text" name="c" id="c" value="{{ $question->c }}" class="form-control @error('c') is-invalid @enderror">
                                    @error('c')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="d" class="col-md-3 col-form-label fw-bold">D:</label>
                                <div class="col-md-12">
                                    <input type="text" name="d" id="d" value="{{ $question->d }}" class="form-control @error('d') is-invalid @enderror">
                                    @error('d')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="answer" class="col-md-3 col-form-label fw-bold">Answer:</label>
                            <div class="col-md-12">
                                <select name="answer" class="form-control">
                                    <option value="{{ $question->answer }}">{{ $question->answer }}</option>
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
        
                    <hr style="background-color: black">
        
                    <div class="form-group row mb-0">
                        <div class=" d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-3" style="background-color: #009DA6; border-color:#009DA6">Update</button>
                            <a href="javascript:history.back()" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
