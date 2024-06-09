@extends('layouts.user')

@section('content')

@php
    $user = auth()->user();
@endphp

<div class="container rounded bg-white p-5">            
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center mb-5">
                <div class="rounded-circle">
                    @if (empty($user->profile_picture))
                        <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" class="rounded-circle" style="width: 200px;">
                    @else 
                        <img src="{{ asset('storage/profile_pictures/'.$user->profile_picture) }}" class="rounded-circle" alt="Upload poster image" style="width: 200px; height:200px; border: 3px solid black;">
                    @endif
                </div>                        
                <span class="font-weight-bold">{{ $user->name }}</span>
            </div>
            <div class="text-center">
                <p class="font-weight-bold fs-5" style="color: #808080">My Account</p>
                <p class="fs-6"><a href="{{ route('users.settings.profile.edit') }}" style="color:black;text-decoration:none">Profile</a></p>
                <p class="font-weight-bold" style="color: #808080">My Learning</p>
                <p class="fs-6"><a href="{{ route('users.getEnrolled') }}" style="color:black;text-decoration:none">Courses</a></p>
                <p class="fs-6"><a href="{{ route('users.getWatchlist') }}" style="color:#009DA6;text-decoration:none">Watchlist</a></p>
            </div>
        </div>
        <div class="col-md-9 border-right pb-5">
            <div class="p-3 pb-5">
                <div class="col-md-12">
                    <h4 class="d-flex justify-content-center"><b>Watchlist</b></h4>
                </div>
                <hr style="border-top: 2px solid black">
                <table class="pb-5 mb-5">
                    @forelse ($courses->chunk(3) as $coursesLimit)
                        <tr>
                            @foreach ($coursesLimit as $item)
                                <td class="p-4" width="150px">
                                    <a href="{{ route('users.course', $item->id) }}" style="color: black; text-decoration: none">
                                        @if (empty($item->course_image))
                                            <img src="https://via.placeholder.com/150x150" class="mb-4 border" width="200" height="150">
                                        @else 
                                            <img src="{{ asset('storage/course_images/'.$item->course_image) }}" class="mb-4 border" width="200" height="150">
                                        @endif
                                        <p><b><span style="font-size: 80%">{{ $item->title }}</span></b></p>
                                        <span style="font-size: 80%">{{ $item->instructor->name }}</span>
                                    </a>
                                </td>
                            @endforeach
                        </tr>
                    @empty
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
    
@endsection