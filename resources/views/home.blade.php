@extends('layouts.app')

@section('content')

<style>
    p{
        color: grey;
        font-weight: bold;
    }

    img {
        width: 130px;
        border-radius: 50%;
        border: 3px #009DA6 solid;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($message = session('message'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif
            <div class="card p-5">
                <div class="card-body">
                    <h3 class="mb-5" style="text-align: center;color: #009DA6;"><b>Select User Type</b></h3>
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <div class="me-5 mt-3">
                                <a href="{{ route('welcome') }}"><img src="{{asset('/images/student.png')}}" style="border-radius: 50%; border: 3px solid #009DA6" class="btn mb-3"></a>
                                <p class="d-flex justify-content-center">STUDENT</p>
                            </div>
                            <div class="me-5 mt-3">
                                <a href="{{ route('admins.dashboard') }}"><img src="{{asset('/images/admin.png')}}" style="border-radius: 50%; border: 3px solid #009DA6" class="btn mb-3"></a>
                                <p class="d-flex justify-content-center">ADMIN</p>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('lecturers.dashboard') }}"><img src="{{asset('/images/lecturer.png')}}" style="border-radius: 50%; border: 3px solid #009DA6" class="btn mb-3"></a>
                                <p class="d-flex justify-content-center">LECTURER</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
