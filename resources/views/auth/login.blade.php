@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card p-5 w-100 m-auto">                
                <div class="ms-3 me-3">
                    @if ($message = session('message'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <div style="margin-left:-1%">
                        <h2 class="mb-4" style="color: #009DA6;"><b>WELCOME BACK</b></h1>
                        <p class="mb-4">Access to your account</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-form-label">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" value="{{ old('password') }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row m-auto">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link d-flex flex-row-reverse mb-2 fs-5" style="color: #009DA6; margin-left: 3%" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <br>
                            <button type="submit" class="btn btn-primary fs-5" style="background-color: #009DA6;">
                                <b>{{ __('Login') }}</b>
                            </button>
                            <br>
                            <p class="d-flex justify-content-center mt-3 fs-5">Don't have an account?
                                <a href="{{ route('register') }}" style="color: #009DA6;">&nbsp;Register Now</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
