@extends('layouts.user')

@section('content')
    <div class="container">
        <div>
            @switch($chapter->lecture_type_id)
                @case(1) {{-- video --}}
                    @php
                        $LectureID = explode('videos/', $chapter->lecture)[1];
                    @endphp
                    <iframe src="https://player.vimeo.com/video/{{ $LectureID }}" width="100%" height="600" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>               
                    @break
                @case(2) {{-- audio --}}
                    <audio controls>
                        <source src="{{ asset('storage/lectures/'.$chapter->lecture) }}" controls>
                    </audio>
                    @break
                @case(3) {{-- text --}}
                    <iframe src="{{ asset('storage/lectures/'.$chapter->lecture) }}" width='100%' height='700'></iframe>
                    @break                    
            @endswitch
        </div>
        <div class="mt-3">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item border-0" style="background-color: #11ffee00;">
                    <a href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color: grey"><b>Chapters</b></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        @foreach ($allChapters as $allChapter)
                            <li><a class="dropdown-item" href="{{ route('users.chapter', $allChapter->id) }}">{{ $allChapter->chapter_no }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('users.chapter', $chapter->id) }}" style="color: grey"><b>Overview</b></a></li>
                <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('users.discussion', $chapter->id) }}" style="color: #009DA6"><b>Discussion</b></a></li>
                <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('users.resource', $chapter->id) }}" style="color: grey"><b>Resources</b></a></li>
                
                @if (empty($quizRecord))
                    
                @else
                    <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('users.quiz', $chapter->id) }}" style="color: grey"><b>Quiz</b></a></li>
                @endif
                
            </ul>
            <hr style="background-color: black">
        </div>
        <div class="ms-3 mt-4">
            <div class="d-flex">
                <div class="col-md-10">
                <h4><b>Discussion</b></h4>
                </div>
                @guest
                        
                    @else
                        @if (auth()->user()->type == 'student' or auth()->user()->type == 'lecturer')
                            <div class="col-md-2">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addComment" style="background-color:#009DA6; border-color:#009DA6;">
                                    Comment
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="addComment" tabindex="-1" role="dialog" aria-labelledby="addCommentLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="addCommentLabel"><b>Leave a Comment</b></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <form action="{{ route('users.store.comment', $chapter->id) }}" method="POST">
                                                @method('POST')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                                                        <input type="text" name="chapter_id" value="{{ $chapter->id }}" hidden>
                                                        <label for="message">Message</label>
                                                        <textarea name="comment" id="comment" rows="5" class="form-control @error('comment') is-invalid @enderror"></textarea>
                                                        @error('comment')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                    
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-secondary">Post Comment</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                @endguest
                
            </div>
        
            {{-- comment listing --}}
            @foreach ($chapterComments as $comment)
            <div>
                <div class="mt-4 d-flex col-md-11">
                    <div class="me-3">
                        @if (empty($comment->user->profile_picture))
                            <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" class="rounded-circle" width="50" height="50">
                        @else 
                            <img src="{{ asset('storage/profile_pictures/'.$comment->user->profile_picture) }}" class="rounded-circle border" width="50" height="50">
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <div class="col-md-10">
                                        <h4><b>{{ $comment->user->name }}</b> <span class="fs-6">- {{ date('d F, Y', strtotime($comment->created_at)) }}</span></h4>
                                        <p class="mt-4">{{ $comment->comment }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addReply{{$comment->id}}" style="background-color:#009DA6; border-color:#009DA6;">
                                            Reply
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="addReply{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="addReplyLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="addReplyLabel"><b>Leave a Reply</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <form action="{{ route('users.store.reply', $chapter->id) }}" method="POST">
                                                        @method('POST')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                                                                <input type="text" name="chapter_id" value="{{ $chapter->id }}" hidden>
                                                                <input type="text" name="parent_id" value="{{ $comment->id }}" hidden>
                                                                <textarea name="comment" id="comment" rows="5" class="form-control @error('comment') is-invalid @enderror"></textarea>
                                                                @error('comment')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                            
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-secondary">Post Comment</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @if(count($comment->replies) > 0) 
                                    <h5 class="mb-4 mt-4 ms-3 fs-6" style="color: grey"><b>REPLIES</b></h5>
                                    @foreach ($comment->replies as $reply)
                                        <div class="d-flex col-md-12">
                                            <div class="me-3">
                                                @if (empty($reply->user->profile_picture))
                                                    <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" class="rounded-circle" width="50" height="50">
                                                @else 
                                                    <img src="{{ asset('storage/profile_pictures/'.$reply->user->profile_picture) }}" class="rounded-circle border" width="50" height="50">
                                                @endif
                                            </div>
                                            <div class="card col-md-11">
                                                <div class="card-body">
                                                    <h5><b>{{ $reply->user->name }}</b> <span class="fs-6">- {{ date('d F, Y', strtotime($reply->created_at)) }}</span></h5>
                                                    <p class="mt-4">{{ $reply->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach   
                                @endif
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            @endforeach
            <div class="mt-4 d-flex justify-content-center">
                {{ $chapterComments->links() }}
            </div>
        </div>
    </div>
@endsection
