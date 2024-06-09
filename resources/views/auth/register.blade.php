@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 w-100 m-auto">
                <div class="ms-3 me-3">
                    <div style="margin-left:-1%">
                        <h2 class="mb-2" style="color: #009DA6;"><b>REGISTER NOW</b></h2>
                        <p class="mb-2" >Make your own account</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row ">
                            <label for="name" class="col-form-label">{{ __('Name') }}</label>

                            <div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row ">
                            <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row ">
                            <label for="birth_date" class="col-form-label">{{ __('Date of Birth') }}</label>

                            <div>
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="birth_date">

                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row ">
                            <label for="password" class="col-form-label">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row ">
                            <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- <div class="row ">
                            <label for="user-type" class="col-form-label">User Type</label>
                            <div>
                                <input value="0" name="type" type="radio"> Student                          
                                <input value="2" name="type" type="radio"> Lecturer
                            </div>
                        </div> --}}
                        <div class="row mt-3">
                            <a href="{{ route('lecturer.register') }}" class="d-flex justify-content-end fw-bold" style="color: #009DA6;">&nbsp;Click here for Instructor Registration</a>                        
                        </div>

                        <div class="row m-auto">
                            <button type="submit" class="btn btn-primary fs-5 mt-3 mb-2" style="background-color: #009DA6;">
                                <b>{{ __('Register') }}</b>
                            </button>
                            <br>
                            <p class="d-flex justify-content-center mt-3 fs-5">Already have an account?
                                <a href="{{ route('login') }}" style="color: #009DA6;">&nbsp;Log In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
