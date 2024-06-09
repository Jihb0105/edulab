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
            <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('users.discussion', $chapter->id) }}" style="color: grey"><b>Discussion</b></a></li>
            <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('users.resource', $chapter->id) }}" style="color: #009DA6"><b>Resources</b></a></li>
            
            @if (empty($quizRecord))
                    
                @else
                    <li class="list-group-item border-0" style="background-color: #11ffee00;"><a href="{{ route('users.quiz', $chapter->id) }}" style="color: grey"><b>Quiz</b></a></li>
                @endif
        
        </ul>
        <hr style="background-color: black">
    </div>
    <div class="ms-3 mt-4 mb-4">
            <table class="table table-striped table-hover mt-3">
                <thead>
                <tr>
                    <th scope="col" >Resource</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($resources as $resource)
                        <tr>
                            <td>{{ $resource->resource }}</td>
                            <td width="150">
                                <a class="btn btn-primary" href="{{ route('users.downloadFile', $resource->id) }}" style="background-color:#009DA6; border-color:#009DA6">Download</a>
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
@endsection